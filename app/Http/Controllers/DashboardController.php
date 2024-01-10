<?php

namespace App\Http\Controllers;

use App\Models\Quotations;
use Illuminate\Http\Request;
use App\Exports\ExportQuotations;
use App\Exports\ExportWonQuotations;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportLostQuotations;
use App\Exports\ExportOpenQuotations;
use App\Exports\ExportCreateQuotations;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    function index(Request $request)
    {
        try{
            $jsonResponse = $this->getGraphData();
            $graphData = json_decode($jsonResponse->getContent(), true);
            return view('dashboard.dashboard', compact('graphData'));
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }
    function getGraphData()
    {
        try{
            $data['create'] = Quotations::where('status', 1)->count();
            $data['open'] = Quotations::where('status', 2)->count();
            $data['won'] = Quotations::where('status', 3)->count();
            $data['lost'] = Quotations::where('status', 4)->count();
            $data['totalEarnComp'] = Quotations::join('customers', 'quotations.customer_id', '=', 'customers.id')->distinct('quotations.customer_id')->count('quotations.customer_id');

            $data['totalEarnItems'] = Quotations::join('customers', 'quotations.customer_id', '=', 'customers.id')->distinct('quotations.id')->count('quotations.id');

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }

    // function getGraphData()
    // {
    //     try {
    //         // Get the current month and year
    //         $currentMonth = date('m');
    //         $currentYear = date('Y');

    //         $data['create'] = Quotations::where('status', 1)
    //             ->whereMonth('created_at', $currentMonth)
    //             ->whereYear('created_at', $currentYear)
    //             ->count();

    //         $data['open'] = Quotations::where('status', 2)
    //             ->whereMonth('created_at', $currentMonth)
    //             ->whereYear('created_at', $currentYear)
    //             ->count();

    //         $data['won'] = Quotations::where('status', 3)
    //             ->whereMonth('created_at', $currentMonth)
    //             ->whereYear('created_at', $currentYear)
    //             ->count();

    //         $data['lost'] = Quotations::where('status', 4)
    //             ->whereMonth('created_at', $currentMonth)
    //             ->whereYear('created_at', $currentYear)
    //             ->count();

    //         $data['totalEarnComp'] = Quotations::join('customers', 'quotations.customer_id', '=', 'customers.id')
    //             ->whereMonth('quotations.created_at', $currentMonth)
    //             ->whereYear('quotations.created_at', $currentYear)
    //             ->distinct('quotations.customer_id')
    //             ->count('quotations.customer_id');

    //         $data['totalEarnItems'] = Quotations::join('customers', 'quotations.customer_id', '=', 'customers.id')
    //             ->whereMonth('quotations.created_at', $currentMonth)
    //             ->whereYear('quotations.created_at', $currentYear)
    //             ->distinct('quotations.id')
    //             ->count('quotations.id');
                
    //         return response()->json($data);
    //     } catch (\Throwable $th) {
    //         return response()->json(['error' => 'An error occurred']);
    //     }
    // }


    function createQuoteDownload(Request $request)
    {
        try{
            return Excel::download(new ExportCreateQuotations, 'quotation.csv', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }
    function openQuoteDownload(Request $request)
    {
        try{
            return Excel::download(new ExportOpenQuotations, 'quotation.csv', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }
    function wonQuoteDownload(Request $request)
    {
        try{
            return Excel::download(new ExportWonQuotations, 'quotation.csv', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }
    function lostQuoteDownload(Request $request)
    {
        try{
            return Excel::download(new ExportLostQuotations, 'quotation.csv', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred']);
        }
    }


}
