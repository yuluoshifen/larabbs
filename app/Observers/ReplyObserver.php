<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //在创建回复时，防止XSS攻击
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        //在创建回复之后,topics 表的 reply_count 字段+1
        $reply->topic->increment('reply_count', 1);
    }
}