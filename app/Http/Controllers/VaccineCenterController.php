<?php

namespace App\Http\Controllers;

use App\Http\Resources\VaccineCenterResource;
use App\Http\Trait\MessageTrait;
use App\Models\VaccineCenter;
use Illuminate\Http\Request;

class VaccineCenterController extends Controller
{
    use MessageTrait;
    public function index(){

        try {
            $centers = VaccineCenter::get();
            return VaccineCenterResource::collection($centers)->additional([
                'success' => true,
                'message' => $this->fetchSuccessMessage,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
