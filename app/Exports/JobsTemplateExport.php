<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobsTemplateExport implements WithHeadings
{   public function headings(): array
    {
        return [
            'title',
            'description',
            'location',
            'company',
            'salary'
        ];
    }
}
