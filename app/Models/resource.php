<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model{
    use HasFactory;
 
    protected $fillable = ['collection_id', 'title', 'subject', 'grade'];

    public function collection(){
        return $this->belongsTo(Collection::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

   public function canEditOrDelete(\App\Models\User $user): bool
    {

        if ($user->isAdmin()) {
            return true;
        }
        
        return $this->collection->user_id === $user->id;
    }
}