<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

trait Favouritable
{
    public static function bootFavouritable()
    {
        static::deleting(function ($model) {
            $model->favourites->each->delete();
        });
    }
    public function makeFavourite()
    {
        if (
            !$this->favourites()
                ->where('user_id', auth()->id())
                ->exists()
        ) {
            $this->favourites()->create(['user_id' => auth()->id()]);
        }
    }
    public function unfavourite()
    {
        $this->favourites()
            ->where(['user_id' => auth()->id()])
            ->get()
            ->each(function ($fav) {
                $fav->delete();
            });
    }
    public function isFavourited()
    {
        return !!$this->favourites->where('user_id', auth()->id())->count();
    }
    public function getisFavouritedAttribute()
    {
        return !!$this->favourites->where('user_id', auth()->id())->count();
    }
    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
}
