<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = \App\Models\AdminJob::all();

        return view('user.userjobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $job = \App\Models\AdminJob::findOrFail($id);

        return view('user.create_userjob', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048', // Maksimum 2MB
        ]);

        $job = \App\Models\AdminJob::findOrFail($id);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Applicant::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'company' => $job->company_name,
            'cv' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect()->route('userjobs.index')->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = \App\Models\AdminJob::findOrFail($id);

        return view('user.detail_userjob', compact('job'));
    }

    public function history()
{
    $applicants = \App\Models\Applicant::where('user_id', auth()->id())->get();

    return view('user.history_user', compact('applicants'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
