<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description'];

    public function requirements()
    {
        return $this->hasMany(CourseRequirement::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
