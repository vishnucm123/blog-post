<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $postsCount = Post::count();


        $usersCount = User::count();

        $user = auth()->user();

        return view('dashboard.analytics.analytics', compact(
            'postsCount',
            'usersCount',
            'user',
        ));

    }
}
