<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\JobVacancy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new JobVacancy([
            'title'       => $row[0],
            'description' => $row[1],
            'location'    => $row[2],
            'company'     => $row[3],
            'salary'      => $row[4],
        ]);
    }
}

