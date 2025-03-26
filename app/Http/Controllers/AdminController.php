<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'posts' => Post::count()
        ]);
    }

    public function users()
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all()
        ]);
    }
}