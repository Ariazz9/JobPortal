<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Application;
use App\Models\JobVacancy;
use App\Mail\JobAppliedMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewApplicationNotification;
use App\Models\User;
use App\Jobs\SendApplicationMailJob;
use App\Mail\ApplicationStatusMail;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $jobId)
    {$applications = Application::with('user', 'job')
    ->where('job_id', $jobId) 
    ->get();
    return view('applications.index', compact('applications', 'jobId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $jobId)
{
    $request->validate([
        'cv' => 'required|mimes:pdf|max:2048',
    ]);
    $cvPath = $request->file('cv')->store('cvs', 'public');
    $application = Application::create([
        'user_id' => auth()->id(),
        'job_id' => $jobId,
        'cv' => $cvPath,
    ]);
    // agar queue berjalan
    dispatch(new SendApplicationMailJob($application->job_id, auth()->user()));
    $admin = User::where('role', 'admin')->first();
    $admin->notify(new NewApplicationNotification($application));
    return back()->with('success', 'Lamaran berhasil dikirim! Cek email Anda.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
{
    $request->validate([
        'status' => 'required|in:Accepted,Rejected',
    ]);

    $application->update([
        'status' => $request->status,
    ]);

    $newStatus = $request->status; 
    
    Mail::to($application->user->email)
        ->queue(new ApplicationStatusMail($application, $newStatus));

    return back()->with('success', 'Status pelamar diperbarui dan email terkirim!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function export($jobId){
    $job = JobVacancy::findOrFail($jobId);
    return Excel::download(new ApplicationsExport($jobId), 'applications.xlsx');
}

}

