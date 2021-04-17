<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function store(Reply $reply)
    {
        $reply->makeFavourite();

        if (request()->expectsJson()) {
            return response(['status' => 'Favourited']);
        }
        return back();
    }
    public function destroy(Reply $reply)
    {
        $reply->unFavourite();

        if (request()->expectsJson()) {
            return response(['status' => 'unFavourited']);
        }
        return back();
    }
}
