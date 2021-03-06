<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class newsController extends Controller
{
    public function index($slug = null)
    {
        $news = News::where('show', 1)->latest()->paginate(12);
        
        if($slug){
            $category = Category::where('unit_id', 1)->where('slug', $slug)->firstOrFail();
            $news = News::where('unit_id', 1)->where('category_id', $category->id)->latest()->paginate(12);
        }
        
        return view('news', compact('news'));
    }

    public function show($slug = null)
    {
        $news = News::where('unit_id', 1)->where('slug', $slug)->firstOrFail();
        $news_more = News::where('unit_id', 1)->where('show', 1)->latest()->limit(3)->get();
        return view('show', compact('news', 'news_more'));
    }
}
