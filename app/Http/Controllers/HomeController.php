<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Article;
use App\Category;
use App\Interchange;


class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth', ['except' => 'success']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $articles = Article::search($request->arg)
            ->with('category','user', 'interchange')
            ->where('is_active', '1')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $user = Auth::user();

        $context['articles'] = $articles;
        $context['user'] = $user;

        return view('home', $context);
    }

    /**
     * Show the successfull register.
     *
     * @return \Illuminate\Http\Response
    */
    public function success() {
        return view('success');
    }

}
