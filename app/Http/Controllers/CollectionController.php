<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = auth()->user()->collections()->withCount('resources')->latest()->get();
        return view('collections.index', compact('collections'));
    }
    
    public function create()
    {
        return view('collections.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);
        
        auth()->user()->collections()->create($validated);
        
        return redirect('/collections')->with('success', 'Collection created successfully!');
    }
    
    public function show($id)
    {
        $collection = auth()->user()->collections()->findOrFail($id);
        $resources = $collection->resources()->with('collection.user')->latest()->get();
        
        return view('collections.show', compact('collection', 'resources'));
    }
}