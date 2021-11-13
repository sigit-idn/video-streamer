<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mirror;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];
    protected $with = ["mirrors"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function mirrors()
    {
        return $this->hasMany(Mirror::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy("start_pos");
    }

    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
                "onUpdate" => true
            ]
        ];
    }
}