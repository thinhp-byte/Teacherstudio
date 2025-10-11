<?php

namespace App\Policies;

use App\Models\User;
use App\Models\resource;
use Illuminate\Auth\Access\Response;

class ResourcePolicy
{
    public function edit(User $user, Resource $resource): bool
    {
        return $resource->collection->user->is($user);
    }
}
