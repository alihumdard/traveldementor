<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DS160 extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ds_160';
    protected $fillable = [
        'application_id',
        'category_id',
        'challan_expiry',
        'ds_160_create_date',
        'ds160',
        'revised_ds160',
        'surname',
        'year_of_birth',
        'sec_question',
        'sec_answer',
        'us_travel_doc_email',
        'us_travel_doc_password',
        'us_travel_doc_updated_password',
        'challan_created',
        'challan_submitted',
        'payment_mode',
        'cgi_ref_no',
        'transaction_date',
        'appoint_date',
        'appoint_reschedule',
        'pick_up_location',
        'premium_delivery',
        'delivery_address'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'application_id','id');
    }
}
