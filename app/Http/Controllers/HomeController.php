<?php

namespace App\Http\Controllers;

use App\Mail\pediMail;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *  public function __construct()
    {
    $this->middleware('auth');
    }
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $user = \App\Models\User::find(5);
//        return $user->blogposts()->get();

        $user = auth()->user();

        Mail::to("pedram@gmail.com")->send(new pediMail($user->name , $user->email));
        return view('home');
    }
}
