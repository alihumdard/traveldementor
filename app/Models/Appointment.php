<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Appointment extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'application_id',
        'country_id',
        'vfs_embassy_id',
        'category_id',
        'no_application',
        'appointment_type',
        'applicant_contact',
        'appointment_email',
        'appointment_contact_no',
        'vfs_appointment_refers',
        'payment_mode',
        'bank_name',
        'card_holder_name',
        'transaction_date',
        'transaction_id',
        'transaction_amount',
        'bio_metric_appointment_date',
        'appointment_reschedule',
        'appointment_refer_no',
        'status',
        'created_by',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'application_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function vfsembassy()
    {
        return $this->belongsTo(VfsEmbassy::class, 'vfs_embassy_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
