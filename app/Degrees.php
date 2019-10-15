<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
    protected $table = 'degrees';
    protected $guarded = [];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "student_degree", 'degree_id')->withTimestamps();
    }
}
