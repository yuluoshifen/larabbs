<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

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

    /**
     * 话题排序
     * 本地作用域允许我们定义通用的约束集合以便在应用中复用,在对应 Eloquent 模型方法前加上一个 scope 前缀,作用域总是返回 查询构建器
     */
    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }

        //预加载防止N+1问题
        return $query->with('user', 'category');
    }

    /**
     * 按更新时间排序（最后回复）
     */
    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * 按创建时间排序（最新发布）
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    //生成模型url
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
