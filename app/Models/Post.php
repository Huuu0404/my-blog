<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'user_name', 'email', 'content', 'created_time', 'updated_time'
    ];

    public $timestamps = false;

}