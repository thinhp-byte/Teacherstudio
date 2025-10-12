<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'school',
        'years_experience',
        'bio',
        'specialization'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experienceLevel(): string
    {
        return match(true) {
            $this->years_experience === 0 => 'New Teacher',
            $this->years_experience < 3 => 'Early Career',
            $this->years_experience < 7 => 'Experienced',
            $this->years_experience < 15 => 'Veteran',
            default => 'Master Educator'
        };
    }

}
