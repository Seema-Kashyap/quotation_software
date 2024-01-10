<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Http\Requests\StoreCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display Index of the resource.
     * @author Rajdipsinh Hada
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Display a listing of the resource.
     * @author Rajdipsinh Hada
     */
    public function list(Request $request)
    {
        $tableFieldData = [];

        // count data with filter value
        $requestFilterCountQuery = Customers::select('customers.*');

        $columnArray = array(
            0 => 'customers.customer_name',
            1 => 'customers.customer_phone',
            2 => 'customers.customer_email'
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columnArray[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $requestFilterCount = $requestFilterCountQuery->count('customers.id');
        $customerQuery = Customers::select('customers.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        // fetch total count without any filter
        $countRecord = Customers::select('customers.*')->count('customers.id');

        $customerList = $customerQuery->get();
        if (!empty($customerList)) {
            $EditButtons = '';
            foreach ($customerList as $key => $single_customer) {
                $tableField['customer_name'] = '<strong>' . $single_customer->customer_name . '</strong> <br/><br/> <strong class="mb-3">GST</strong>: <span class="mb-3">' . $single_customer->customer_gst_number . '</span><br/> <strong>Address</strong>: <span>' . $single_customer->customer_address.' </span>';
                $tableField['customer_phone'] = $single_customer->customer_phone;
                $tableField['customer_email'] = $single_customer->customer_email;

                $EditButtons = '<div class="actions-btn text-center">';
                $EditButtons .= '<a href="javascript:void(0)" id="customer-' . $single_customer->id . '" class="btn-edit customer_popup_open" title="Edit">';
                $EditButtons .= '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $EditButtons .= '<path d="M8 3H2.55556C2.143 3 1.74733 3.16389 1.45561 3.45561C1.16389 3.74733 1 4.143 1 4.55556V15.4444C1 15.857 1.16389 16.2527 1.45561 16.5444C1.74733 16.8361 2.143 17 2.55556 17H13.4444C13.857 17 14.2527 16.8361 14.5444 16.5444C14.8361 16.2527 15 15.857 15 15.4444V10" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '<path d="M14.1791 1.48399C14.489 1.1741 14.9093 1 15.3476 1C15.7858 1 16.2061 1.1741 16.516 1.48399C16.8259 1.79388 17 2.21418 17 2.65243C17 3.09068 16.8259 3.51099 16.516 3.82088L9.11586 11.221L6 12L6.77896 8.88414L14.1791 1.48399Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '</svg>';                  
                $EditButtons .= '</a>';
                $EditButtons .= '</div>';


                // $EditButtons = '<a class="customer_popup_open btn btn-info" id="customer-' . $single_customer->id . '" href="javascript:void(0);" data-toggle="tooltip" title="Edit">Edit</a>';
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
     * Show the form for creating a new resource.
     * @author Rajdipsinh Hada
     */
    public function create(Request $request)
    {
        if ($request->id == 0) {
            $customers_create_html = view('customers.create')->render();
            return response()->json(array('status' => true, 'customers_html' => $customers_create_html));
        } else {
            return response()->json(array('status' => false, 'customers_html' => ''));
        }
        exit();
    }

    /**
     * Store a newly created resource in storage.
     * @author Rajdipsinh Hada
     */
    public function store(StoreCustomersRequest $request)
    {
        $status = false;
        if ($request->id == 0) {
            $customer_object = new Customers();
            $customer_object->customer_name = $request->customer_name;
            $customer_object->customer_gst_number = $request->customer_gst_number;
            $customer_object->customer_phone = $request->customer_phone;
            $customer_object->customer_email = $request->customer_email;
            $customer_object->customer_address = $request->customer_address;
            $customer_object->save();
            $status = true;
        }
        return response()->json(array('status' => $status));

    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @author Rajdipsinh Hada
     */
    public function edit(Request $request)
    {
        if ($request->id != 0) {
            $customer_object = Customers::find($request->id);
            if(!empty($customer_object)) {
                $customers_edit_html = view('customers.edit',compact('customer_object'))->render();
                return response()->json(array('status' => true, 'customers_html' => $customers_edit_html));
            } else {
                return response()->json(array('status' => false, 'customers_html' => ''));
            }
        } else {
            return response()->json(array('status' => false));
        }
        exit();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomersRequest $request)
    {
        $status = false;
        if ($request->id != 0) {
            $customer_object = Customers::find($request->id);
            $customer_object->customer_name = $request->customer_name;
            $customer_object->customer_gst_number = $request->customer_gst_number;
            $customer_object->customer_phone = $request->customer_phone;
            $customer_object->customer_email = $request->customer_email;
            $customer_object->customer_address = $request->customer_address;
            $customer_object->update();
            $status = true;
        }
        return response()->json(array('status' => $status));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customers $customers)
    {
        //
    }

     /**
     * Search entity of Customer.
     */
    public function search(Request $request)
    {
        $data = Customers::where('customer_name', 'LIKE', $request->customer_search.'%')
            ->get();
        // declare an empty array for output
        $output = '';
        // if searched countries count is larager than zero
        if (count($data)>0) {
            // concatenate output to the array
            $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
            // loop through the result array
            foreach ($data as $row){
                // concatenate output to the array
                $output .= '<li class="list-group-item" data-id="'.$row->id.'">'.$row->customer_name.'</li>';
            }
            // end of output
            $output .= '</ul>';
        }
        else {
            // if there's no matching results according to the input
            $output .= '<li class="list-group-item">'.'No results'.'</li>';
        }
        // return output result array
        return response()->json($output);
    }
}
