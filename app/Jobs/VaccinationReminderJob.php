<?php

namespace App\Jobs;

use App\Mail\VaccinationReminderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class VaccinationReminderJob implements ShouldQueue
{
    use Queueable;

    public $user;
    public $scheduledDate;
    public $centerName;

    /**
     * Create a new job instance.
     */
    public function __construct($user,$scheduledDate,$centerName)
    {
        $this->user = $user;
        $this->scheduledDate = $scheduledDate;
        $this->centerName = $centerName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send( new VaccinationReminderMail($this->user, $this->scheduledDate,$this->centerName));

    }
}
