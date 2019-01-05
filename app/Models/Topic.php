<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    /**
     * 话题和分类一对一关系
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 话题和用户一对一关系
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
