<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function load($tst){
        // return view('pages', compact('tst'));
        return view('pages')->with('tst',$tst);
    }
}
