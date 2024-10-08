<?php

namespace App\Jobs;

use App\Mail\SendEmailNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationJob implements ShouldQueue
{
    use Queueable;
    private $name;
    private $email;
    private $scheduledDate;

    /**
     * Create a new job instance.
     */
    public function __construct($name,$email,$scheduledDate)
    {
        $this->name = $name;
        $this->email = $email;
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendEmailNotificationMail($this->name, $this->scheduledDate));
    }
}
