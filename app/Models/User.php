<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function collections(){
        return $this->hasMany(Collection::class, 'user_id');
    }

    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    public function isAdmin(): bool
    {
        return $this->email === 'admin@admin.com';
    }

    /**
 * Users that this user follows
 */
public function following()
{
    return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
        ->withTimestamps();
}

/**
 * Users that follow this user
 */
public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
        ->withTimestamps();
}

/**
 * Check if this user follows another user
 */
public function isFollowing(User $user): bool
{
    return $this->following()->where('following_id', $user->id)->exists();
}

/**
 * Follow a user
 */
public function follow(User $user): void
{
    if (!$this->isFollowing($user) && $this->id !== $user->id) {
        $this->following()->attach($user->id);
    }
}

/**
 * Unfollow a user
 */
public function unfollow(User $user): void
{
    $this->following()->detach($user->id);
}
}
