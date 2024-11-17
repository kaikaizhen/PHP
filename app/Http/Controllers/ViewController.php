<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function Map(){
        return view('Map.OSM');
    }

    public function Log(){
        return view('Log.Log');
    }

    public function LogShow(){
        return view('Log.show');
    }

    public function About(){
        return view('About.about');
    }
}
