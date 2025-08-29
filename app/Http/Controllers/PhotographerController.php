<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photographers;
use Illuminate\Support\Facades\Validator;

class PhotographerController extends Controller
{
    /**
     * Display a listing of the photographers.
     */
    public function index()
    {
        $photographers = Photographers::all();
        return view('photographers.index', compact('photographers'));
    }

    /**
     * Show the form for creating a new photographer.
     */
    public function create()
    {
        return view('photographers.create');
    }

    /**
     * Store a newly created photographer in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'email' => 'required|email|unique:photographers,email',
            'phone' => 'required|string|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name','specialty','email','phone']);

        // Handle profile picture
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/photographers', $filename);
            $data['profile_pic'] = $filename;
        }

        Photographers::create($data);

        return redirect()->route('photographers.index')->with('success', 'Photographer added successfully.');
    }

    /**
     * Display the specified photographer.
     */
    public function show(string $id)
    {
        $photographer = Photographers::findOrFail($id);
        return view('photographers.show', compact('photographer'));
    }

    /**
     * Show the form for editing the specified photographer.
     */
    public function edit(string $id)
    {
        $photographer = Photographers::findOrFail($id);
        return view('photographers.edit', compact('photographer'));
    }

    /**
     * Update the specified photographer in storage.
     */
    public function update(Request $request, string $id)
    {
        $photographer = Photographers::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'email' => 'required|email|unique:photographers,email,'.$photographer->id,
            'phone' => 'required|string|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name','specialty','email','phone']);

        // Handle profile picture
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/photographers', $filename);
            $data['profile_pic'] = $filename;
        }

        $photographer->update($data);

        return redirect()->route('photographers.index')->with('success', 'Photographer updated successfully.');
    }

    /**
     * Remove the specified photographer from storage.
     */
    public function destroy(string $id)
    {
        $photographer = Photographers::findOrFail($id);

        // Delete profile picture if exists
        if ($photographer->profile_pic) {
            \Storage::delete('public/photographers/'.$photographer->profile_pic);
        }

        $photographer->delete();

        return redirect()->route('photographers.index')->with('success', 'Photographer deleted successfully.');
    }
}