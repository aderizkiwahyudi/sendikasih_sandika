<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }
    public function recruitment()
    {
        return $this->hasOne(Recruitment::class, 'user_id', 'user_id');
    }
}
