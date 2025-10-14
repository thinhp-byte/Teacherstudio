<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::has('teacherProfile')
            ->with('teacherProfile')
            ->withCount(['followers', 'collections'])
            ->orderBy('name')
            ->paginate(12);
            
        return view('teachers.index', [
            'teachers' => $teachers
        ]);
    }
}