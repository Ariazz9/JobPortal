<?php
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $notifications = auth()->user()->notifications;
    return view('dashboard', compact('notifications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/jobs', [JobController::class, 'index']);
Route::get('/admin', function () {
return "Halo Admin!";
})->middleware(['auth', 'isAdmin']);


//Route::get('/profile', function () {
  //  return view('profile');
//})->middleware(['auth']);

Route::get('/admin/jobs', function () {
    return view('jobs'); 
})->middleware(['auth', 'isAdmin']);


Route::resource('jobs',
JobController::class)->middleware(['auth','isAdmin'])->except(['index', 'show']);
require __DIR__.'/auth.php';

Route::resource('jobs',
JobController::class)->middleware(['auth'])->only(['index','show']);

Route::post('/jobs/{job}/apply',
[ApplicationController::class,
'store'])->name('apply.store')->middleware('auth');

Route::get('/jobs/{job}/applicants',
[ApplicationController::class,
'index'])->name('applications.index')->middleware(['isAdmin']);

Route::resource('applications',
ApplicationController::class)->middleware(['auth',
'isAdmin'])->except(['index', 'show']);

Route::resource('applications',
ApplicationController::class)->middleware(['auth'])->only(
['index', 'show']);

Route::get('/jobs/{job}/export-applicants', [ApplicationController::class, 'export'])
    ->name('applications.export')->middleware('isAdmin');

Route::post('/jobs/import', [JobController::class,
'import'])->name('jobs.import')->middleware('isAdmin');

Route::get('/jobs/import/template', [JobController::class, 'downloadTemplate'])
->name('jobs.template')
->middleware('isAdmin');