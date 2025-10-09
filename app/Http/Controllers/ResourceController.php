<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
         $resources=resource::with("collection")->latest()->simplepaginate(3);
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
    'grade'=>'required'
   ]);

   resource::create([
    'collection_id'=>1,
    'title'=>request('title'),
    'subject'=>request('subject'),
    'grade'=>request('grade')
   ]);
    return redirect('/resources');
    }

    public function edit(Resource $resource)
    {
        return view('resources.edit', [
        'resource' => $resource
    ]);
    }

    public function update(Resource $resource)
    {
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
        $resource->delete();
    return redirect('/resources');
    }
}
