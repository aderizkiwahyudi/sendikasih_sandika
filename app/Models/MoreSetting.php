<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreSetting extends Model
{
    use HasFactory;

    protected $table = 'more_setting';

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
