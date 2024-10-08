<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_name',
        'max_capacity',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getAvailableSlotsForDate($date)
    {
        return $this->max_capacity - $this->registrations()->where('scheduled_date', $date)->count();
    }



}
