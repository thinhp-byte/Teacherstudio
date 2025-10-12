<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Resource extends Model{
    use HasFactory;
 
    protected $fillable = ['collection_id', 'title', 'subject', 'grade'];

    public function collections(){
    return $this->belongsToMany(Collection::class);
    }

   public function canEditOrDelete(User $user): bool
    {

        if ($user->isAdmin()) {
            return true;
        }
        
        return $this->collections()->where('user_id', $user->id)->exists();
    }
}