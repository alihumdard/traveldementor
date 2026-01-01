<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes,HasFactory;
    protected $guarded=[];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'user_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
