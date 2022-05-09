<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    public function contribution_items()
    {
        return $this->hasMany(ContributionItem::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function more_setting()
    {
        return $this->hasOne(MoreSetting::class);
    }
}
