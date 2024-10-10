<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\RegistrationRequest;
use App\Http\Requests\Registration\SearchRequest;
use App\Http\Service\RegistrationService;
use App\Http\Trait\MessageTrait;
use App\Jobs\SendEmailNotificationJob;
use App\Models\User;
use Carbon\Carbon;

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
            return response()->json(['message' => 'User registered successfully','success'=> true]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function vaccinationRegistrationSearch(SearchRequest $request){
        try {
            $user = User::whereNid($request->nid)->with('registration')->first();
            $today = Carbon::today();
            $scheduled_date = Carbon::parse($user->registration->scheduled_date);

            if ($scheduled_date->isBefore($today)) {
                $user->registration->vaccination_status = $this->vaccinatedStatus;
                $user->registration->save();
            }
            switch ($user->registration->vaccination_status) {
                case $this->notRegisteredStatus:
            return response()->json(['message' => 'Not Registered','success'=> true]);

                case $this->scheduledStatus:
            return response()->json(['message' => 'Scheduled','success'=> true]);

                case $this->vaccinatedStatus:
            return response()->json(['message' => 'Vaccinated','success'=> true]);

            }
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
