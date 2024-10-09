<?php

namespace App\Http\Trait;

trait MessageTrait
{
    private $notRegisteredStatus = 0;
    private $scheduledStatus = 1;
    private $vaccinatedStatus = 2;

    private $fetchSuccessMessage = 'Fetch Success';

}
