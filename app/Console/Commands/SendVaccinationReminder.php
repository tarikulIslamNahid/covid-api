<?php

namespace App\Console\Commands;

use App\Jobs\VaccinationReminderJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendVaccinationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-vaccination-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vaccination reminder email to users scheduled for the next day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get tomorrow's date
        $tomorrow = Carbon::tomorrow()->toDateString();

        $users = User::with('registration.vaccineCenter')
            ->whereHas('registration', function($query) use ($tomorrow) {
                $query->where('scheduled_date', $tomorrow);
            })->get();
            foreach ($users as $user) {
                $scheduledDate = $user->registration->scheduled_date;
                $centerName = $user->registration->vaccineCenter->center_name;
                VaccinationReminderJob::dispatch($user,$scheduledDate,$centerName);
            }
        // Log to console
        $this->info('Vaccination reminders have been sent to users scheduled for tomorrow.');

    }
}
