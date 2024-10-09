<?php

namespace App\Http\Service;

use App\Http\Trait\MessageTrait;
use App\Models\Registration;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    use MessageTrait;
    public function registration(Request $request){
        DB::beginTransaction();
        try {
             $user = new User;
             $user->name = $request->name;
             $user->email = $request->email;
             $user->nid = $request->nid;
             $user->save();
            db::commit();
            // schedule vaccination registration
            $this->scheduleVaccinationRegistration($user->id,$request);
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function scheduleVaccinationRegistration($user_id,$request){
        $vaccinationCenter = VaccineCenter::find($request->vaccine_center_id);
        $availableDate = $this->getAvailableDate($vaccinationCenter);
        $userAlreadyScheduled = Registration::whereUserId($user_id)->whereVaccinationStatus($this->scheduledStatus)->first();
        if($availableDate && !$userAlreadyScheduled){
            $registration = new Registration;
            $registration->user_id = $user_id;
            $registration->vaccine_center_id = $vaccinationCenter->id;
            $registration->scheduled_date = $availableDate;
            $registration->vaccination_status = $this->scheduledStatus;
            $registration->save();
        }
    }

    private function getAvailableDate($vaccinationCenter){
        $today = now();
        $weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];

        while (true) {
            if (in_array($today->format('l'), $weekdays)) {
                $registeredCount = Registration::whereVaccineCenterId($vaccinationCenter->id)
                    ->whereScheduledDate($today->toDateString())
                    ->count();

                if ($registeredCount < $vaccinationCenter->max_capacity) {
                    return $today->toDateString();
                }
            }
            $today->addDay();
        }
    }
}
