<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\RegistrationRequest;
use App\Http\Service\RegistrationService;
use App\Jobs\SendEmailNotificationJob;

class RegistrationController extends Controller
{
    private $registrationService;

    public function __construct(RegistrationService $RegistrationService) {
        $this->registrationService = $RegistrationService;
    }
    public function userRegister(RegistrationRequest $request){
        try {
            $user = $this->registrationService->registration($request);
            // scheduled date
            $scheduledDate = $user->registration->scheduled_date;
            // Send email notification
            SendEmailNotificationJob::dispatch($user,$scheduledDate);
            return response()->json(['message' => 'User registered successfully']);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
