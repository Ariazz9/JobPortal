<?php

namespace App\Jobs;
use App\Models\JobVacancy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedMail;

class SendApplicationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $jobModel;
public $user;

public function __construct($jobModel, $user)
{
    $this->jobModel = $jobModel;
    $this->user = $user;
}

public function handle()
{
    $job = JobVacancy::findOrFail($this->jobModel);
    Mail::to($this->user->email)
        ->send(new JobAppliedMail($job, $this->user));
}
}
