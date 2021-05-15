<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl_model;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get From Models
        $ShortUrl_model =  new ShortUrl_model();
        $countShorten = $ShortUrl_model->CountShorten();
        $lastShorten = $ShortUrl_model->GetLastShorten();
        $lastshortenLink = $ShortUrl_model->GetLastShortenUrl();
        //return dd($ShortUrl_model->GetLastShortenUrl());

        return view('home', compact('countShorten','lastShorten','lastshortenLink'));
    }
}
