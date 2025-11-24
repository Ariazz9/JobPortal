<?php

namespace App\Http\Controllers;
use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\JobsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobsTemplateExport;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $jobs = Job::all();
    return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'location' => 'required',
        'company' => 'required',
        'logo' => 'image|mimes:jpg,png,jpeg|max:2048',
        'jenis_pekerjaan' => 'required'
    ]);

    $logoPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    Job::create([
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'company' => $request->company,
        'salary' => $request->salary,
        'logo' => $logoPath,
        'jenis_pekerjaan' => $request->jenis_pekerjaan
    ]);

    return redirect()->route('jobs.index')
        ->with('success', 'Lowongan berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show(Job $job)
{
    return view('jobs.show', compact('job'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $job = Job::findOrFail($id); 
    return view('jobs.edit', compact('job')); 
}
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'location' => 'required',
        'company' => 'required',
        'jenis_pekerjaan' => 'required',
        'logo' => 'image|mimes:jpg,png,jpeg|max:2048', 
    ]);
    $job = Job::findOrFail($id);
    $data = $request->only(['title', 'description', 'location', 'company', 'salary', 'jenis_pekerjaan']);
    if ($request->hasFile('logo')) {
        if ($job->logo) {
            Storage::disk('public')->delete($job->logo); 
        }
        $logoPath = $request->file('logo')->store('logos', 'public');
        $data['logo'] = $logoPath;
    }
    $job->update($data);

    return redirect()->route('jobs.index')
        ->with('success', 'Lowongan berhasil diperbarui');
}

    public function destroy($id)
{
    $job = Job::findOrFail($id); 
     if ($job->logo) {
         Storage::disk('public')->delete($job->logo);
     }

    $job->delete(); 

    return redirect()->route('jobs.index')
        ->with('success', 'Lowongan berhasil dihapus');
}

public function import(Request $request)
{
$request->validate(['file' =>
'required|mimes:xlsx,csv']);
Excel::import(new JobsImport,
$request->file('file'));
return back()->with('success', 'Data lowongan
berhasil diimport');}


public function downloadTemplate()
{
    return Excel::download(new JobsTemplateExport, 'template_lowongan.xlsx');
}}