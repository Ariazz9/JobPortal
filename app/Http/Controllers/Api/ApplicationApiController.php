<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationApiController extends Controller
{
    public function index(Request $req)
    {
        if ($req->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $apps = Application::with(['user', 'job'])
            ->latest()
            ->paginate($req->get('per_page', 10));

        return response()->json($apps);
    }

    public function store(Request $req, Job $job)
    {
        // validate file CV (required)
        $req->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        // upload CV
        $cvPath = $req->file('cv')->store('cvs', 'public');

        // create application
        $app = Application::create([
            'user_id' => $req->user()->id,
            'job_id'  => $job->id,
            'cv'      => $cvPath,
            'status'  => 'Pending',
        ]);

        return response()->json([
            'message'     => 'Application submitted',
            'application' => $app
        ], 201);
    }
    public function updateStatus (Request $req, Application $application)
{
    if ($req->user()->role !== 'admin') {
        return response()->json(['message' => 'Forbidden'], 403);
    }

    $data = $req->validate([
        'status' => 'required|in:Pending,Accepted,Rejected',                   
    ]);

    $application->update($data);

    return response()->json([
        'message' => 'Application status updated', 
        'application' => $application
    ]);
}
}
