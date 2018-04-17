<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{

    public function viewHome()
    {

        $sections = Section::where('is_active', true)->orderBy('order')->with('pieces')->get();

        return view('generator.viewHome', compact('sections'));
    }

}
