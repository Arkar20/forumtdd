<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\RecordActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Reflection;

class Favourite extends Model
{
    use RecordActivity;

    protected $guarded = [];

    public function favourited()
    {
        return $this->morphTo();
    }
}
