<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
    ];

    public static function isFriendIdExists($user, $friend_info)
    {
        $user_friend_list = Friend::where('user_id', $user->id);

        return $user_friend_list->where('friend_id', $friend_info->id)->exists();
    }
}
