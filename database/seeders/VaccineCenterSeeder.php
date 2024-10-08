<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make 10 vaccine centers
        $vaccineCenters = [
            [
                'center_name' => 'Dhaka Vaccination Center',
                'max_capacity' => 200,
            ],
            [
                'center_name' => 'Chittagong Vaccination Center',
                'max_capacity' => 150,
            ],
            [
                'center_name' => 'Khulna Vaccination Center',
                'max_capacity' => 50,
            ],
            [
                'center_name' => 'Rajshahi Vaccination Center',
                'max_capacity' => 80,
            ],
            [
                'center_name' => 'Barisal Vaccination Center',
                'max_capacity' => 60,
            ],
            [
                'center_name' => 'Sylhet Vaccination Center',
                'max_capacity' => 40,
            ],
            [
                'center_name' => 'Comilla Vaccination Center',
                'max_capacity' => 50,
            ],
            [
                'center_name' => 'Gazipur Vaccination Center',
                'max_capacity' => 70,
            ],
            [
                'center_name' => 'Tangail Vaccination Center',
                'max_capacity' => 40,
            ],
            [
                'center_name' => 'Narayanganj Vaccination Center',
                'max_capacity' => 30,
            ],

        ];
        foreach ($vaccineCenters as $vaccineCenter) {
            VaccineCenter::create($vaccineCenter);
        }
    }
}
