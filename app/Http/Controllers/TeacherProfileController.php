<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherProfileController extends Controller
{
    public function create()
    {
        // Redirect if they already have a profile
        if (auth()->user()->teacherProfile) {
            return redirect()->route('profile.edit');
        }
        
        return view('teacher-profile.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school' => 'required|string|max:255',
            'years_experience' => 'required|integer|min:0|max:50',
            'bio' => 'required|string|min:50|max:500',
            'specialization' => 'required|string|max:255',
        ]);
        
        auth()->user()->teacherProfile()->create($validated);
        
        return redirect('/resources')->with('success', 'Profile created successfully!');
    }
    
    public function edit()
    {
        $profile = auth()->user()->teacherProfile;
        
        if (!$profile) {
            return redirect()->route('profile.setup');
        }
        
        return view('teacher-profile.edit', compact('profile'));
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'school' => 'required|string|max:255',
            'years_experience' => 'required|integer|min:0|max:50',
            'bio' => 'required|string|min:50|max:500',
            'specialization' => 'required|string|max:255',
        ]);
        
        auth()->user()->teacherProfile()->update($validated);
        
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}