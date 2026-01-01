<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'application_id',
        'country_id',
        'plan_type',
        's_date',
        'e_date',
        'policy_no',
        'sale_date',
        'amount',
        'payable_after_40_per',
        'net_payable',
        'refund_applied',
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
        return $this->hasMany(Alert::class, 'insurance_id');
    }
}
