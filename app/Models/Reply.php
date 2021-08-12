<?php

namespace App\Models;
use Carbon\Carbon;

use App\Models\Favouritable;
use App\Models\RecordActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, RecordActivity, Favouritable;

    protected $fillable = ['body', 'user_id', 'thread_id'];
    protected $with = ['owner', 'favourites', 'thread'];
    protected $appends = ['isFavourited', 'favourites_count'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($reply) {
            return $reply->thread()->increment('replies_count');
        });
        static::deleted(function ($reply) {
            return $reply->thread()->decrement('replies_count');
        });
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }
    public function wasUploaded()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }
}
