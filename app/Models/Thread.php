<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Channel;
use App\Models\Activity;
use App\Models\RecordActivity;
use App\Models\ThreadSubscription;
use App\Notifications\ThreadUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory, RecordActivity;

    protected $fillable = ['user_id', 'title', 'body', 'channel_id'];
    protected $with = ['author', 'channel'];

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
        // return '/threads/' . $this->channel->slug . '/' . $this->id;
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class)->withCount('favourites');
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);
        $this->notifySubscribers($reply);
        // $this->subscriptions
        //     ->filter(function ($sub) use ($reply) {
        //         return $sub->thread->user_id != $reply->user_id;
        //     })
        //     ->each(function ($sub) use ($reply) {
        //         $sub->thread->author->notify(new ThreadUpdated($this, $reply));
        //     });

        return $reply;
    }
    public function notifySubscribers($reply)
    {
        $this->subscriptions
            ->where('user_id', '!=', $reply->user_id)
            ->each->notify($reply);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    public function subscribe($user = null)
    {
        return $this->subscriptions()->create([
            'user_id' => $user ?: auth()->id(),
        ]);
    }
    public function unsubscribe($user = null)
    {
        return $this->subscriptions()->delete([
            'user_id' => $user ?: auth()->id(),
        ]);
    }
    public function togglesubscribe($user = 1)
    {
        if ($this->isSubscribed) {
            $result = $this->unsubscribe($user);
        } else {
            $result = $this->subscribe($user);
        }

        return response(['status' => $this->isSubscribed]);
    }
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }
    public function getIsSubscribedAttribute($user = null)
    {
        return $this->subscriptions()
            ->where('user_id', $user ?: auth()->id())
            ->exists();
    }
    public function hasUpdateFor()
    {
        return $this->updated_at >
            cache(
                auth()
                    ->user()
                    ->makeCacheKey($this)
            );
    }
}
