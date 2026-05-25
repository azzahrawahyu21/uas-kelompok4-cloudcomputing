<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class UserController extends Controller
{
    public function index()
    {
        $menus = Menu::with('submenus')->get()->groupBy('url');
        return view('user.dashboard', compact('menus'));
    }
}
