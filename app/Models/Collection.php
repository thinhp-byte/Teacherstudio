<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\CollectionFactory> */
    use HasFactory;
    
    protected $fillable = ['user_id', 'name'];
    
    public function resources(){
        return $this->hasMany(Resource::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
