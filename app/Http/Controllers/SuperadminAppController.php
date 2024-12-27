<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class SuperadminAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = Applicant::all();
        
        return view('superadmin.superapp', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Method not needed in this case, can be removed or implemented later
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Method not needed in this case, can be removed or implemented later
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Return the applicant's data as JSON for use in the modal
        $applicant = Applicant::findOrFail($id);
        return response()->json($applicant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::findOrFail($id);

        return view('superadmin.edit_superapp', compact('applicant'));
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
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255',
            'status' => 'required|in:pending,accepted,rejected',
        ]);
    
        // Find applicant and update
        $applicant = Applicant::findOrFail($id);
        $applicant->update($request->only(['name', 'email', 'company', 'status']));

        // Redirect with success message
        return redirect()->route('superapps.index')->with('success', 'Applicant status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the applicant and delete
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();

        // Redirect with success message
        return redirect()->route('superapps.index')->with('success', 'Applicant deleted successfully!');
    }
}
