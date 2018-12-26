<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /*
     * 个人信息展示页
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /*
     * 个人信息编辑页
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /*
     * 个人信息执行编辑
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功!');
    }
}
