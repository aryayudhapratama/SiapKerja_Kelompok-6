<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminJob;

class WelcomeController extends Controller
{
    public function index()
    {
        $jobs = \App\Models\AdminJob::all();

        return view('welcome_page', compact('jobs'));
    }

    public function show($id)
    {
        $job = AdminJob::findOrFail($id); 

        return view('detail_welcome', compact('job'));
    }
}
