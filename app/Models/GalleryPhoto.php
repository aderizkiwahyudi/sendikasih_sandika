<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $table = 'gallery_photos';

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
