<?php

namespace App\Exports;

use App\Models\Quotations;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLostQuotations implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotations::where('status', 4)->get();
    }

    // public function headings(): array
    // {
    //     return [
    //         'Number',
    //         'Date',
    //         'Company name',
    //         'Amount',
    //         'Status',
    //     ];
    // }
}
