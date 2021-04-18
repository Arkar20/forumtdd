<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
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
        return new ReplyResource($thread->replies()->paginate(1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug, Thread $thread, Request $request)
    {
        // dd($thread);
        $reply = $thread->addReply([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);
        if (request()->expectsJson()) {
            return $reply->load('owner');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
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
        // $reply->favourites()->delete();
        // $reply->activity()->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply updated']);
        }
        return back();
        return back();
    }
}
