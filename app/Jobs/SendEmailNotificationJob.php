<?php

namespace App\Jobs;

use App\Mail\SendEmailNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationJob implements ShouldQueue
{
    use  Queueable;
    public $user;
    public $scheduledDate;

    /**
     * Create a new job instance.
     */
    public function __construct($user,$scheduledDate)
    {
        $this->user = $user;
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new SendEmailNotificationMail($this->user, $this->scheduledDate));
    }
}
