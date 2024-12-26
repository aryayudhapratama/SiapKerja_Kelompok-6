<?php

namespace App\Http\Controllers;

use App\Models\AdminJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperadminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = AdminJob::all();
        return view('superadmin.superjob', compact('jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $job = AdminJob::findOrFail($id);
        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $job = AdminJob::findOrFail($id);

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update gambar jika ada
        if ($request->hasFile('picture')) {
            if ($job->picture) {
                Storage::disk('public')->delete($job->picture);
            }
            $validatedData['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $job->update($validatedData);

        return redirect()->route('superjobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = AdminJob::findOrFail($id);

        // Hapus file gambar jika ada
        if ($job->picture) {
            Storage::disk('public')->delete($job->picture);
        }

        $job->delete();

        return redirect()->route('superjobs.index')->with('success', 'Job deleted successfully.');
    }
}
