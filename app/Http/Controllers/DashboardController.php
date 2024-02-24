<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'user' => User::count()
        ];
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'count' => $count
        ]);
    }
}
