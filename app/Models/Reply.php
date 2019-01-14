<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    /**
     * 回复和用户一对一关系
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 回复和话题一对一关系
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
