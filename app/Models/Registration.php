<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
