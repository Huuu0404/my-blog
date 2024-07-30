<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeAction extends Model
{
    use HasFactory;

    protected $table = 'like_actions';

    protected $fillable = [
        'user_name',
        'post_id',
        'user_id',
    ];

    // 定義關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
