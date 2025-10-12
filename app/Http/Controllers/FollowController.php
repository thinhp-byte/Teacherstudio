<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Follow a user
     */
    public function store(User $user)
    {
        auth()->user()->follow($user);
        
        return back()->with('success', 'You are now following ' . $user->name);
    }
    
    /**
     * Unfollow a user
     */
    public function destroy(User $user)
    {
        auth()->user()->unfollow($user);
        
        return back()->with('success', 'You unfollowed ' . $user->name);
    }
}