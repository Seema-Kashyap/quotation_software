<?php

namespace App\Http\Controllers;


use App\Models\Quotations;
use App\Models\Customers;
use App\Models\QuotationsDetail;
use App\Models\BasicAmountDiscountApplicables ;
use App\Models\CommercialTermsGsts ;
use App\Models\QuotationsFileNotes;
use App\Models\PaymentForSparesOrServices;
use App\Models\DeliveryOfPartsServices;
use App\Models\DeliveryTerms;
use App\Http\Requests\StoreQuotationsRequest;
use App\Http\Requests\UpdateQuotationsRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use PDF;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @author Rajdipsinh Hada
     */
    public function index()
    {
        return view('quotations.index');
    }

    /**
     * Display a listing of the resource.
     * @author Rajdipsinh Hada
     */
    public function list(Request $request)
    {
        $tableFieldData = [];

        // count data with filter value
        $requestFilterCountQuery = QuotationsDetail::select('quotations_details.*')->leftJoin('customers','customers.id','=','quotations_details.customer_id');

        $columnArray = array(
            0 => 'quotations_details.id',
            1 => 'quotations_details.created_at',
            2 => 'quotations_details.customer_name',
            3 => 'quotations_details.quotation_descount_basic_amount',
        );

        if (isset($request->top_search) && !empty($request->top_search)) {
            $searchVal = $request['top_search'];
            $requestFilterCountQuery->where(function ($query) use ($searchVal) {
                $query->orWhere('customers.customer_name',$searchVal);
            });
        }

        if (isset($request->start_date) && !empty($request->start_date)) {
            $searchValStartDate = $request['start_date'];
            $requestFilterCountQuery->where(function ($query) use ($searchValStartDate) {
                $query->orWhere(DB::raw('str_to_date(quotations_details.created_at, "%Y-%m-%d")'),'>=',$searchValStartDate);
            });
        }

        if (isset($request->end_date) && !empty($request->end_date)) {
            $searchValEndDate = $request['end_date'];
            $requestFilterCountQuery->where(function ($query) use ($searchValEndDate) {
                $query->orWhere(DB::raw('str_to_date(quotations_details.created_at, "%Y-%m-%d")'),'<=',$searchValEndDate);
            });
        }

        if (isset($request->status) && !empty($request->status)) {
            $searchValstatus = $request['status'];
            $requestFilterCountQuery->where(function ($query) use ($searchValstatus) {
                $query->orWhere('customers.status',$searchValstatus);
            });
        }

        $requestFilterCount = $requestFilterCountQuery->count('quotations_details.id');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columnArray[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $quotationsDetailsQuery = QuotationsDetail::select('quotations_details.*','customers.customer_name')
            ->leftJoin('customers','customers.id','=','quotations_details.customer_id')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        if (isset($request->top_search) && !empty($request->top_search)) {
            $searchVal = $request['top_search'];
            $quotationsDetailsQuery->where(function ($query) use ($searchVal) {
                $query->orWhere('customers.customer_name',$searchVal);
            });
        }

        if (isset($request->start_date) && !empty($request->start_date)) {
            $searchValStartDate = $request['start_date'];
            $quotationsDetailsQuery->where(function ($query) use ($searchValStartDate) {
                $query->orWhere(DB::raw('str_to_date(quotations_details.created_at, "%Y-%m-%d")'),'>=',$searchValStartDate);
            });
        }

        if (isset($request->end_date) && !empty($request->end_date)) {
            $searchValEndDate = $request['end_date'];
            $quotationsDetailsQuery->where(function ($query) use ($searchValEndDate) {
                $query->orWhere(DB::raw('str_to_date(quotations_details.created_at, "%Y-%m-%d")'),'<=',$searchValEndDate);
            });
        }

        if (isset($request->status) && !empty($request->status)) {
            $searchValstatus = $request['status'];
            $quotationsDetailsQuery->where(function ($query) use ($searchValstatus) {
                $query->orWhere('customers.status',$searchValstatus);
            });
        }

        // fetch total count without any filter
        $countRecord = QuotationsDetail::select('quotations_details.*')->leftJoin('customers','customers.id','=','quotations_details.customer_id')->count('quotations_details.id');

        $quotationsDetailsList = $quotationsDetailsQuery->get();
        if (!empty($quotationsDetailsList)) {
            $EditButtons = '';
            foreach ($quotationsDetailsList as $key => $single_quotation) {
                $tableField['id'] = $single_quotation->id;
                $tableField['created_at'] = date('d/m/Y',strtotime($single_quotation->created_at));
                // $customer_detail = Customers::select('customer_name')->where('id',$single_quotation->customer_id)->first();
                $tableField['customer_name'] = $single_quotation->customer_name;
                $tableField['quotation_descount_basic_amount'] = $single_quotation->quotation_descount_basic_amount;

                $status = '';
                if($single_quotation->status == '1') {
                    $status = '<span class="badge badge-info">Create</span>';
                } else if($single_quotation->status == '2') {
                    $status = '<span class="badge badge-dark">Open</span>';
                } else if($single_quotation->status == '3') {
                    $status = '<span class="badge badge-light">Won</span>';
                } else if($single_quotation->status == '4') {
                    $status = '<span class="badge badge-secondary">Lost</span>';
                }

                $tableField['status'] = $status;
                $tableField['export'] = '<a href="'.route('quotations.export_quotation_pdf',['id' => $single_quotation->id]).'" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Export As PDF</a>';

                $EditButtons = '<div class="actions-btn text-center">';
                $EditButtons .= '<a href="'.route('quotations.edit',[$single_quotation->id]).'" class="btn-edit" title="Edit">';
                $EditButtons .= '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $EditButtons .= '<path d="M8 3H2.55556C2.143 3 1.74733 3.16389 1.45561 3.45561C1.16389 3.74733 1 4.143 1 4.55556V15.4444C1 15.857 1.16389 16.2527 1.45561 16.5444C1.74733 16.8361 2.143 17 2.55556 17H13.4444C13.857 17 14.2527 16.8361 14.5444 16.5444C14.8361 16.2527 15 15.857 15 15.4444V10" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '<path d="M14.1791 1.48399C14.489 1.1741 14.9093 1 15.3476 1C15.7858 1 16.2061 1.1741 16.516 1.48399C16.8259 1.79388 17 2.21418 17 2.65243C17 3.09068 16.8259 3.51099 16.516 3.82088L9.11586 11.221L6 12L6.77896 8.88414L14.1791 1.48399Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '</svg>';
                $EditButtons .= '</a>';
                $EditButtons .= '</div>';


                // $EditButtons = '<a class="btn btn-info" href="'.route('quotations.edit',[$single_quotation->id]).'" data-toggle="tooltip" title="Edit">Edit</a>';
                $tableField['action'] = $EditButtons;
                $tableFieldData[] = $tableField;
            }
        }
        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($countRecord),
            "recordsFiltered" => intval($requestFilterCount),
            "data" => $tableFieldData
        );
        return response()->json($json_data);
    }

    /**
     * Create the form for creating a new resource.
     * @author Rajdipsinh Hada
     */
    public function create()
    {
        $basic_amount = BasicAmountDiscountApplicables::where('is_gst','1')->get()->toArray();
        $basic_gst_applicable = BasicAmountDiscountApplicables::where('is_gst','0')->first();
        $commercial_gst = CommercialTermsGsts::all();
        $spares_services = PaymentForSparesOrServices::all();
        $parts_service = DeliveryOfPartsServices::all();
        $delivery_terms = DeliveryTerms::all();
        return view('quotations.create',compact('basic_amount','basic_gst_applicable','commercial_gst','spares_services','delivery_terms','parts_service'));
    }

    /**
     * Store a newly created resource in storage.
     * @author Rajdipsinh Hada
     */
    public function store(Request $request)
    {
        $quotation_detail_data = new QuotationsDetail();
        $quotation_detail_data->customer_id = $request->customer_id;
        $quotation_detail_data->quotation_note = $request->quotation_note;
        $quotation_detail_data->quotations_gst = $request->gst;
        $quotation_detail_data->commercial_terms_gst = $request->commercial_terms_gst;
        $quotation_detail_data->payment_spares_or_service = $request->payment_spares_or_service;
        $quotation_detail_data->delivery_parts_service = $request->delivery_parts_service;
        $quotation_detail_data->delivery_terms = $request->delivery_terms;
        $quotation_detail_data->commercial_terms_note = $request->commercial_terms_note;
        $quotation_detail_data->quotation_descount_basic_amount = $request->quotation_descount_basic_amount;
        $quotation_detail_data->created_at = date('Y-m-d H:i:s');
        $quotation_detail_data->our_reference = $request->our_reference;
        $quotation_detail_data->save();

        // Convert the JSON data to a PHP array
        $json = $_POST["cellValues"];
        $cellValues = json_decode($json, true);

        if(!empty($cellValues)) {
            foreach ($cellValues as $header => $single_cell_value) {
                if($header != 0) {
                    $qutotations_data = new Quotations();
                    $qutotations_data->hsn_code = $single_cell_value[1];
                    $qutotations_data->product_code = $single_cell_value[2];
                    $qutotations_data->material_description = $single_cell_value[3];
                    $qutotations_data->quantity = $single_cell_value[4];
                    $qutotations_data->uom = $single_cell_value[5];
                    $qutotations_data->list_price = $single_cell_value[6];
                    $qutotations_data->discount = $single_cell_value[7];
                    $qutotations_data->unit_cost_in_inr = $single_cell_value[8];
                    $qutotations_data->factor = $single_cell_value[9];
                    $qutotations_data->unit_price_in_inr = $single_cell_value[10];
                    $qutotations_data->total_cost_in_inr = $single_cell_value[11];
                    $qutotations_data->total_price_in_inr = $single_cell_value[12];
                    $qutotations_data->profit = $single_cell_value[13];
                    $qutotations_data->status = '2';
                    $qutotations_data->customer_id = $request['customer_id'];
                    $qutotations_data->quotation_detail_id = $quotation_detail_data->id;
                    $qutotations_data->save();
                }
            }
        }
        return redirect()->route('quotations.index');
    }

    /**
     * Search HSN
     * @author Rajdipsinh Hada
    */

    public function search_hsn(Request $request)
    {
        $status = false;
        $json_response = array();
        $quotation_details_by_hsn = Quotations::Where('hsn_code', 'like', $request->hsn_code . '%')->first();
        if(!empty($quotation_details_by_hsn) && $quotation_details_by_hsn != '') {
            $status = true;
            $json_response = $quotation_details_by_hsn;
        }
        return response()->json(array('status' => $status, 'json_response' => $json_response));
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotations $quotations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quotation_detail = QuotationsDetail::find($id);
        $quotation_table_detail = Quotations::where('quotation_detail_id',$quotation_detail->id)->get()->toArray();
        $customer_detail = Customers::select('customer_name')->where('id',$quotation_detail->customer_id)->first();
        $quotations_file_notes = QuotationsFileNotes::where('quotations_id',$quotation_detail->id)->get()->toArray();

        $basic_amount = BasicAmountDiscountApplicables::where('is_gst','1')->get()->toArray();
        $basic_gst_applicable = BasicAmountDiscountApplicables::where('is_gst','0')->first();
        $commercial_gst = CommercialTermsGsts::all();
        $spares_services = PaymentForSparesOrServices::all();
        $parts_service = DeliveryOfPartsServices::all();
        $delivery_terms = DeliveryTerms::all();
        return view('quotations.edit',compact('basic_amount','basic_gst_applicable','commercial_gst','spares_services','delivery_terms','parts_service','quotation_detail','quotation_table_detail','customer_detail','quotations_file_notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $quotation_detail_data = QuotationsDetail::find($request->id);
        $quotation_detail_data->customer_id = $request->customer_id;
        $quotation_detail_data->quotation_note = $request->quotation_note;
        $quotation_detail_data->quotations_gst = $request->gst;
        $quotation_detail_data->commercial_terms_gst = $request->commercial_terms_gst;
        $quotation_detail_data->payment_spares_or_service = $request->payment_spares_or_service;
        $quotation_detail_data->delivery_parts_service = $request->delivery_parts_service;
        $quotation_detail_data->delivery_terms = $request->delivery_terms;
        $quotation_detail_data->commercial_terms_note = $request->commercial_terms_note;
        $quotation_detail_data->quotation_descount_basic_amount = $request->quotation_descount_basic_amount;
        $quotation_detail_data->created_at = date('Y-m-d H:i:s');
        $quotation_detail_data->our_reference = $request->our_reference;
        $quotation_detail_data->update();

        // Convert the JSON data to a PHP array
        $json = $_POST["cellValues"];
        $cellValues = json_decode($json, true);

        if(!empty($cellValues)) {
            foreach ($cellValues as $header => $single_cell_value) {
                if($header != 0) {
                    if(isset($single_cell_value[0]) && $single_cell_value[0] != 0) {
                        $qutotations_data = Quotations::find($single_cell_value[0]);
                        $qutotations_data->hsn_code = $single_cell_value[2];
                        $qutotations_data->product_code = $single_cell_value[3];
                        $qutotations_data->material_description = $single_cell_value[4];
                        $qutotations_data->quantity = $single_cell_value[5];
                        $qutotations_data->uom = $single_cell_value[6];
                        $qutotations_data->list_price = $single_cell_value[7];
                        $qutotations_data->discount = $single_cell_value[8];
                        $qutotations_data->unit_cost_in_inr = $single_cell_value[9];
                        $qutotations_data->factor = $single_cell_value[10];
                        $qutotations_data->unit_price_in_inr = $single_cell_value[11];
                        $qutotations_data->total_cost_in_inr = $single_cell_value[12];
                        $qutotations_data->total_price_in_inr = $single_cell_value[13];
                        $qutotations_data->profit = $single_cell_value[14];
                        $qutotations_data->customer_id = $request['customer_id'];
                        $qutotations_data->quotation_detail_id = $quotation_detail_data->id;
                        $qutotations_data->update();
                    } else {
                        $qutotations_data = new Quotations();
                        $qutotations_data->hsn_code = $single_cell_value[2];
                        $qutotations_data->product_code = $single_cell_value[3];
                        $qutotations_data->material_description = $single_cell_value[4];
                        $qutotations_data->quantity = $single_cell_value[5];
                        $qutotations_data->uom = $single_cell_value[6];
                        $qutotations_data->list_price = $single_cell_value[7];
                        $qutotations_data->discount = $single_cell_value[8];
                        $qutotations_data->unit_cost_in_inr = $single_cell_value[9];
                        $qutotations_data->factor = $single_cell_value[10];
                        $qutotations_data->unit_price_in_inr = $single_cell_value[11];
                        $qutotations_data->total_cost_in_inr = $single_cell_value[12];
                        $qutotations_data->total_price_in_inr = $single_cell_value[13];
                        $qutotations_data->profit = $single_cell_value[14];
                        $qutotations_data->customer_id = $request['customer_id'];
                        $qutotations_data->quotation_detail_id = $quotation_detail_data->id;
                        $qutotations_data->save();
                    }
                }
            }
        }
        return redirect()->route('quotations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotations $quotations)
    {
        //
    }

    /**
     * Download PDF.
     * @author Rajdipsinh Hada
     */
    public function export_quotation_pdf(Request $request)
    {
        $quotation_detail_data = QuotationsDetail::find($request->id);
        if(!empty($quotation_detail_data)) {
            $customer_detail = Customers::where('id',$quotation_detail_data->customer_id)->first();
            $quotation_data = Quotations::where('quotation_detail_id',$quotation_detail_data->id)->get()->toArray();
            // $total_price_in_inr = $quotation_data->sum('total_price_in_inr');
            // $total_cost_in_inr = $quotation_data->sum('total_cost_in_inr');
            // $subtotal = $quotation_data->sum('total_price_in_inr');

            $data = [
                'quotation_data' =>  $quotation_data,
                'customer_detail' => $customer_detail,
                'quotation_detail_data' => $quotation_detail_data,
            ];
            $pdf = PDF::loadView('quotations.quotation_pdf', $data);
            $file_name = $customer_detail->customer_name.'.pdf';
            return $pdf->download($file_name);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @author Rajdipsinh Hada
     */
    public function remove_row(Request $request)
    {
        $status = false;
        if(isset($request->remove_id) && !empty($request->remove_id)) {
            $qutotations_data = Quotations::find($request->remove_id);
            $qutotations_data->delete();
            $status = true;
        }
        return response()->json(array('status' => $status));
    }

    /**
     * Upload the specified resource from storage.
     * @author Rajdipsinh Hada
     */
    public function upload_purchase_quote(Request $request)
    {
        $status = false;
        $message = 'There is Some Error Please Try Again!';
        $upload_dir = 'uploads'.DIRECTORY_SEPARATOR;
        if (!file_exists($upload_dir)) {
            // Create a new file or direcotry
            mkdir($upload_dir, 0777, true);
        }

        if ($request->hasfile('quotations_files')) {
            foreach ($request->file('quotations_files') as $uplod_file_key =>  $file) {
                $name = $file->getClientOriginalName();

                $quotation_file_notes = new QuotationsFileNotes();
                $quotation_file_notes->purchase_quotations_file = $name;
                $quotation_file_notes->quotations_id  = $request->quotation_id;
//                if($uplod_file_key == 0) {
                $quotation_file_notes->purchase_quotations_notes = $request->purchase_quotations_notes;
//                }
                $quotation_file_notes->save();
                $file->move(public_path() . '/uploads/', $name);
                $status = true;
                $message = 'Successfully Uploded Files';
            }
        }
        return response()->json(array('message' => $message,'status' => $status));
    }
    /**
     * Remove the specified resource from storage.
     * @author Rajdipsinh Hada
     */
    public function file_remove(Request $request)
    {
        $status = false;
        $message = 'There is Some Error Please Try Again!';

        $get_file_info = QuotationsFileNotes::find($request->remove_id);
        if($get_file_info) {
            $file_path = public_path('uploads/').$get_file_info->purchase_quotations_file;
            if (file_exists($file_path)) {
                unlink($file_path);
                $get_file_info->delete();
                $status = true;
                $message = 'Successfully Removed Files';
            }
        }
        return response()->json(array('message' => $message,'status' => $status));
    }


}
