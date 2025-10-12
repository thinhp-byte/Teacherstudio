<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResourcePosted;


class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with([
            'collection.user.teacherProfile'
        ]);
        
        // Search by title or subject
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        // Filter by grade
        if ($grade = $request->get('grade')) {
            $query->where('grade', $grade);
        }
        
        $resources = $query->latest()->simplePaginate(3);
        
        return view('resources.index', [
            'resources' => $resources
        ]);
    }
    public function create()
    {
        return view('resources.create');
    }   

    public function show(Resource $resource)
    {
        return view('resources.show', [
        'resource' => $resource
    ]);
    }   

    public function store()
    {
    request()->validate([
        'title'=>['required','min:3'],
        'subject'=>'required',
        'grade'=>'required',
        'collection_id'=>'required|exists:collections,id'
    ]);

    $resource = Resource::create([
        'collection_id'=> request('collection_id'),
        'title'=>request('title'),
        'subject'=>request('subject'),
        'grade'=>request('grade')
    ]);
   if ($resource->collection->user) {
        try {
            Mail::to($resource->collection->user)->queue(
                new ResourcePosted($resource)
            );
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            \Log::error('Failed to send ResourcePosted email: ' . $e->getMessage());
        }
    }

    return redirect('/resources');
    }

    public function edit(Resource $resource)
    {
        
        Gate::authorize('edit-resource', $resource);

        return view('resources.edit', [
        'resource' => $resource
    ]);
    }

    public function update(Resource $resource)
    {
        Gate::authorize('edit-resource', $resource);
        request()->validate([
    'title'=>['required','min:3'],
    'subject'=>'required',
    'grade'=>'required'
   ]);

    $resource->update([
        'title'=>request('title'),
        'subject'=>request('subject'),
        'grade'=>request('grade')
    ]);
    return redirect('/resources/'.$resource->id);
    }

    public function destroy(Resource $resource)
    {
        Gate::authorize('edit-resource', $resource);
        $resource->delete();
    return redirect('/resources');
    }
}
