<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 必ずUserモデルをインポートする

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all(); // すべてのユーザーを取得
        return view('users.index', compact('users'));
    }
}
