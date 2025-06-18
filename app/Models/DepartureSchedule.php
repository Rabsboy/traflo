<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['travel_package_id', 'departure_date'];

    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class);
    }
}
