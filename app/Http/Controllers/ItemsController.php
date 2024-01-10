<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->id == 0) {
            $items_create_html = view('items.create')->render();
            return response()->json(array('status' => true, 'items_html' => $items_create_html));
        } else {
            return response()->json(array('status' => false, 'items_html' => ''));
        }
        exit();
    }

    /**
     * Display a listing of the resource.
     * @author Rajdipsinh Hada
     */
    public function list(Request $request)
    {
        $tableFieldData = [];

        // count data with filter value
        $requestFilterCountQuery = Items::select('items.*');

        $columnArray = array(
            0 => 'items.item_name',
            1 => 'items.item_hsn_code',
            2 => 'items.item_vendor'
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columnArray[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $requestFilterCount = $requestFilterCountQuery->count('items.id');
        $itmesQuery = Items::select('items.*')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        // fetch total count without any filter
        $countRecord = Items::select('items.*')->count('items.id');

        $itemsList = $itmesQuery->get();
        if (!empty($itemsList)) {
            $EditButtons = '';
            foreach ($itemsList as $key => $single_itmes) {
                $tableField['item_name'] = '<span>' . $single_itmes->item_name . '</span>';
                $tableField['item_hsn_code'] = $single_itmes->item_hsn_code;
                $tableField['item_vendor'] = $single_itmes->item_vendor;

                $EditButtons = '<div class="actions-btn text-center">';
                $EditButtons .= '<a href="javascript:void(0)" id="items-' . $single_itmes->id . '" class="btn-edit items_popup_open" title="Edit">';
                $EditButtons .= '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $EditButtons .= '<path d="M8 3H2.55556C2.143 3 1.74733 3.16389 1.45561 3.45561C1.16389 3.74733 1 4.143 1 4.55556V15.4444C1 15.857 1.16389 16.2527 1.45561 16.5444C1.74733 16.8361 2.143 17 2.55556 17H13.4444C13.857 17 14.2527 16.8361 14.5444 16.5444C14.8361 16.2527 15 15.857 15 15.4444V10" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '<path d="M14.1791 1.48399C14.489 1.1741 14.9093 1 15.3476 1C15.7858 1 16.2061 1.1741 16.516 1.48399C16.8259 1.79388 17 2.21418 17 2.65243C17 3.09068 16.8259 3.51099 16.516 3.82088L9.11586 11.221L6 12L6.77896 8.88414L14.1791 1.48399Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>';
                $EditButtons .= '</svg>';                  
                $EditButtons .= '</a>';
                $EditButtons .= '</div>';


                // $EditButtons = '<a class="items_popup_open btn btn-info" id="items-' . $single_itmes->id . '" href="javascript:void(0);" data-toggle="tooltip" title="Edit">Edit</a>';
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
     * Store a newly created resource in storage.
     */
    public function store(StoreItemsRequest $request)
    {
        $status = false;
        if ($request->id == 0) {
            $itmes_object = new Items();
            $itmes_object->item_name = $request->item_name;
            $itmes_object->item_hsn_code = $request->item_hsn_code;
            $itmes_object->item_vendor = $request->item_vendor;
            $itmes_object->item_description = $request->item_description;
            $itmes_object->item_gst_percentage = $request->item_gst_percentage;
            $itmes_object->save();
            $status = true;
        }
        return response()->json(array('status' => $status));
    }

    /**
     * Display the specified resource.
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->id != 0) {
            $items_object = Items::find($request->id);
            if(!empty($items_object)) {
                $items_html_edit_html = view('items.edit',compact('items_object'))->render();
                return response()->json(array('status' => true, 'items_html' => $items_html_edit_html));
            } else {
                return response()->json(array('status' => false, 'items_html' => ''));
            }
        } else {
            return response()->json(array('status' => false));
        }
        exit();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemsRequest $request, Items $items)
    {
        $status = false;
        if ($request->id != 0) {
            $itmes_object = Items::find($request->id);
            $itmes_object->item_name = $request->item_name;
            $itmes_object->item_hsn_code = $request->item_hsn_code;
            $itmes_object->item_vendor = $request->item_vendor;
            $itmes_object->item_description = $request->item_description;
            $itmes_object->item_gst_percentage = $request->item_gst_percentage;
            $itmes_object->update();
            $status = true;
        }
        return response()->json(array('status' => $status));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $items)
    {
        //
    }
}
