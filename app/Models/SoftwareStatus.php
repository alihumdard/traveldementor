<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name','type','created_by'];
    public static $rules = [
        'name' => 'required|unique:software_statuses,name',
        'status_type' => 'required',
    ];
}
