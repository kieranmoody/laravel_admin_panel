<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $fillable = ['name', 'email', 'description', 'website', 'slug'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
