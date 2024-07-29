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
    ];
}
