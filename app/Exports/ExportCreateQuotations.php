<?php

namespace App\Exports;

use App\Models\Quotations;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ExportCreateQuotations implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotations::where('status', 1)->get();
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
