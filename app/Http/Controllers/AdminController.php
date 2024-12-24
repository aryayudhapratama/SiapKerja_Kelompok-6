<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $jobs = \App\Models\AdminJob::all();

        return view('admin.admin1', compact('jobs'));
    }
}
