<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Rules\SpanFree;
use App\Rules\FrequentReply;
use Illuminate\Http\Request;
use App\Notifications\MentionUser;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ReplyResource;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($channelid, Thread $thread)
    {
        return new ReplyResource(
            $thread
                ->replies()
                ->latest()
                ->paginate(1)
        );
    }

    public function store($slug, Thread $thread, Request $request)
    {
        // $span->detect(request('body'));
        $this->vaidateReply();

        // if (Gate::denies('create', new Reply())) {
        //     return response('You are Posting too Frequently', 422);
        // }

        $reply = $thread->addReply([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);

        preg_match_all('/\@([^\s\.])+/', $reply->body, $matches);
        dd($matches);
        foreach ($matches[1] as $name) {
            $user = User::where('name', $name)->get();
            if ($user) {
                $user->notify(new MentionUser($reply));
            }
        }
        return $reply->load('owner');
    }

    public function update(Request $request, Reply $reply)
    {
        $this->vaidateReply();
        $this->authorize('delete', $reply);

        $reply->update(['body' => request('body')]);

        if (request()->expectsJson()) {
            return response(['status' => 'Reply updated']);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply updated']);
        }
        return back();
    }
    public function vaidateReply()
    {
        $this->validate(request(), [
            'body' => ['required', new SpanFree(), new FrequentReply()],
        ]);
        // resolve(Span::class)->detect(request('body'));
    }
}
