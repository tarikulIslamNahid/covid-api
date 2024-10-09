<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\RegistrationRequest;
use App\Http\Requests\Registration\SearchRequest;
use App\Http\Service\RegistrationService;
use App\Http\Trait\MessageTrait;
use App\Jobs\SendEmailNotificationJob;
use App\Models\User;

class RegistrationController extends Controller
{
    use MessageTrait;
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

    public function vaccinationRegistrationSearch(SearchRequest $request){
        try {
            $user = User::whereNid($request->nid)->with('registration')->first();
            switch ($user->registration->vaccination_status) {
                case $this->notRegisteredStatus:
                    return 'Not Registered';
                case $this->scheduledStatus:
                    return 'Scheduled';
                case $this->vaccinatedStatus:
                    return 'Vaccinated';
            }
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
