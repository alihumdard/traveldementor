<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','sur_name','contact_no','refer_person','dob','created_by','staff_id'];
}
