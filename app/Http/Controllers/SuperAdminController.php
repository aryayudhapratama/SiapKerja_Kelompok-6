<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminJob;
use App\Models\Applicant;
use App\Models\SuperUser;



class SuperAdminController extends Controller
{
    public function index()
    {
        $users = SuperUser::all();
        $applicants = Applicant::all();
        $jobs = AdminJob::all();
        return view('superadmin.superadmin',  compact('users', 'jobs', 'applicants'));
    }

//     public function dashboard()
// {
//     $jobs = Job::all();
//     $applicants = Applicant::all();
//     $users = User::all();

//     return view('superadmin.dashboard', compact('jobs', 'applicants', 'users'));
// }
}
