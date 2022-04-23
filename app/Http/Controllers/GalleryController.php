<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('gallery', compact('galleries'));
    }

    public function show($slug = null)
    {
        $gallery = Gallery::where('slug', $slug)->firstOrFail();
        return view('gallery', compact('gallery'));
    }
}
