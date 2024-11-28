<?php

namespace App\Http\Controllers;

use App\Models\AdminJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperadminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = AdminJob::all();

        return view('superadmin.superjob', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = AdminJob::findOrFail($id);

        return view('superadmin.edit_superjob', compact('job'));
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
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $job = AdminJob::findOrFail($id);
        $job->company_name = $request->company_name;
        $job->description = $request->description;
        $job->address = $request->address;
        $job->category = $request->category;
    
        if ($request->hasFile('picture')) {
            // Perintah untuk menghapus gambar
            if ($job->picture) {
                Storage::disk('public')->delete($job->picture);
            }
            $job->picture = $request->file('picture')->store('images', 'public');
        }
    
        $job->save();
    
        return redirect()->route('superjobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = AdminJob::findOrFail($id);
    
        // Perintah untuk menghapus gambar
        if ($job->picture) {
            Storage::disk('public')->delete($job->picture);
        }

        $job->delete();

        return redirect()->route('superjobs.index')->with('success', 'Job deleted successfully.');
    }
}
