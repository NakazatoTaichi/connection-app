<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupUser;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'group_description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }

    public function groupMessages()
    {
        return $this->hasMany(GroupMessage::class);
    }

    public function groupMemberCount($group_id)
    {
        $group_member_count = GroupUser::where('group_id', $group_id)->count();

        return $group_member_count;
    }
}
