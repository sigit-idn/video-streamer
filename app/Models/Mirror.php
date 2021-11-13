<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mirror extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the Mirror
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}