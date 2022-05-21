<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Slide;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $news = News::where('unit_id', 1)->where('show', 1)->latest()->limit(4)->get();
        $slides = Slide::where('unit_id', 1)->get();
        return view('welcome', compact('news', 'slides'));
    }
}
