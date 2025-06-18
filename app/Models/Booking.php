<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'travel_package_id',
        'payment_method',
        'booking_code',
        'payment_status',
        'departure_date'

    ];
    public function travelPackage()
{
    return $this->belongsTo(TravelPackage::class);
}
public function userByEmail()
{
    return $this->belongsTo(User::class, 'email', 'email');
}

}

