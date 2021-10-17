<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function chapters() {
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
