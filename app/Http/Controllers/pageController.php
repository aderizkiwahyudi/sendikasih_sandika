<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageFile;
use App\Models\UnitNameStructure;
use Illuminate\Http\Request;

class pageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $page = null; $items = null;
        
        if($request->segment(2) == 'rencana-strategis' || $request->segment(2) == 'perjanjian-kerja'){
            $items = PageFile::where('category', $request->segment(2))->get();
        }else{
            $page = Page::where('unit_id', 1)->where('slug', $request->slug)->firstOrFail();
        }

        $structures = UnitNameStructure::get();

        return view('page', compact('page', 'items', 'structures'));
    }
}
