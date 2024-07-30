<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'user_name', 'email', 'content', 'created_time', 'updated_time', 'user_id'
    ];

    public $timestamps = false;

    // 定義關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeAction::class);
    }

}