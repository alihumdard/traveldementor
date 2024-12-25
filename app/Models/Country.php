<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'status', 'created_by'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function getCodeAttribute($value)
    {
        return strtoupper($value);
    }
    public static $rules = [
        'name' => 'required|unique:categories,name',
        'type' => 'required',
    ];
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
