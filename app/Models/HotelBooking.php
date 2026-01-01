<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBooking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'country_id',
        's_date',
        'e_date',
        'hotel_cancel_due_date',
        'name',
        'reservation_id',
        'reservation_email',
        'status',
        'created_by',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'application_id', 'id');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'hotel_booking_id');
    }
}
