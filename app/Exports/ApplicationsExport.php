<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings 
{
    protected $jobId;
    public function __construct(int $jobId)
    {
        $this->jobId = $jobId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    return Application::with('user', 'job')
    ->where('job_id', $this->jobId)
    ->get()
    ->map(function($app) {
                            
    return [
    'Nama Pelamar' => $app->user->name,
    'Email' => $app->user->email,
    'Lowongan' => $app->job->title,
    'Status' => $app->status,
    'Tanggal Lamar' => $app->created_at->format('Y-m-d'),];});}

    public function headings(): array
    {
        return [
            "Nama Pelamar",
            "Email",
            "Lowongan",
            "Status",
            "Tanggal Lamar"
        ];
    }
}
