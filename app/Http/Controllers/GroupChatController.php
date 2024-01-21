<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupChatController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('groupChat.index', compact('groups'));
    }

    public function create()
    {
        return view('groupChat.create');
    }

    public function store(Request $request)
    {
        $group = Group::create([
            'group_name' => $request['group_name'],
        ]);

        return redirect()->route('groupChat.index', compact('group'));
    }
}
