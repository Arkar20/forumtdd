<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use App\Notifications\ThreadUpdated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function makeCacheKey($thread)
    {
        return sprintf('user.%s.visits.%s', auth()->id(), $thread->id);
    }
}
