<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Contracts\Support\Renderable;

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

        $this->middleware('permission:ContactUs', ['only' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $contact_us = ContactUs::orderBy('created_at','DESC')->get();
        return view('dashboard',compact('contact_us'));
    }
}
