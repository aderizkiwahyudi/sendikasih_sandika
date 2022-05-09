<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ckeditor extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->hasFile('upload')){
            $file = $request->file('upload');
            $filename = $file->getClientOriginalName();
            $filerename = time() . '-' . $filename;
            $file->move('img', $filerename);

            echo json_encode([
                'url' => asset('img/' . $filerename),
            ]);
        }
    }
}
