<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class NewApplicationNotification extends Notification
{
    use Queueable;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
{
    return ['mail', 'database'];
}

public function toDatabase($notifiable)
{
    return [
        'message' => 'Lamaran baru dari ' . $this->application->user->name,
        'job_id' => $this->application->job_id,
        'application_id' => $this->application->id,
    ];
}

    public function toMail($notifiable)
{
    $cvUrl = Storage::url($this->application->cv);

    return (new MailMessage)
        ->subject('Lamaran Baru Diterima') 
        ->line('Ada lamaran baru untuk pekerjaan: '. 
               $this->application->job->title)
        ->line('Pelamar: ' . 
               $this->application->user->name) 

        ->line('Anda dapat mengunduh CV pelamar dengan tombol di bawah:')
        ->action('Download CV', url($cvUrl)); 

        //->action('Lihat Daftar Lamaran', 
        //       url('/applications/' . $this->application->job_id)); 
}
}
