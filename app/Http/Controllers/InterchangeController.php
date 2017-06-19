<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;
use App\Http\Requests;
use App\Interchange;

class InterchangeController extends Controller {

    protected $homePath = '/home';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $context['interchanges'] = DB::table('interchanges')
            ->join('articles', 'interchanges.article_id', '=', 'articles.id')
            ->join('users', 'interchanges.users_id', '=', 'users.id')
            ->select('interchanges.*', 'articles.points as points', 'articles.name as artName','users.name as username', 'users.last_name as userlastname')
            ->where('articles.user_id', Auth::user()->id)->orderBy('interchanges.created_at', 'DESC')->paginate(10);

        $howInter = count($context['interchanges']);
        $context['howinter'] = $howInter;

        return view('interchanges.index', $context);
    }

    public function store($id) {
        //dd($id);
        $article_id = $id;
        $interchange = new Interchange();
        $interchange['article_id'] = $article_id;

        if($interchange->article->points > Auth::user()->points) {
            $interchange->delete();
            return redirect($this->homePath)->with('notice', 'Le faltan puntos.');
        }

        $interchange['users_id'] = Auth::user()->id;
        //Para el usuario que solicita
        Auth::user()->points -= $interchange->article->points;
        //Para los puntos del propietario de artículo
        $interchange->article->user->points += $interchange->article->points;

        $interchange->save();
        Auth::user()->save();
        $interchange->article->user->save();

        $article = Article::find($article_id);
        $article->trans = 1;
        $article->save();

        return redirect($this->homePath)->with('message', 'Artículo solicitado, ahora tiene ' . Auth::user()->points . ' puntos.');
    }

    public function show() {
        $context['interchanges'] = DB::table('interchanges')
            ->join('articles', 'interchanges.article_id', '=', 'articles.id')
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->select('interchanges.*', 'articles.points as points', 'articles.name as artName','users.name as username', 'users.last_name as userlastname')
            ->where('interchanges.users_id', '=', Auth::user()->id)->orderBy('interchanges.created_at', 'DESC')
            ->get();
            //dd($context);
        $howInter = count($context['interchanges']);
        $context['howinter'] = $howInter;

        return view('interchanges.index2', $context);
    }


    public function send($id) {
        $interchange = Interchange::find($id);
        $interchange->status = 'sending';
        $interchange->save();
        return back()
            ->with('message', 'El artículo se ha enviado.');
    }


    public function deliver($id) {
        $interchange = Interchange::find($id);
        $interchange->status = 'checked';
        $interchange->save();
        //Recompensa de puntos extras
        $puntosExtras = rand(1, 10);
        $interchange->article->user->points += $puntosExtras;
        $interchange->article->user->save();

        return back()
            ->with('message', 'Genial, no olvides agradecer por mensajes.');
    }

    public function cancel($id) {
        $interchange = Interchange::find($id);
        //Revertir puntos
        Auth::user()->points += $interchange->article->points;
        $interchange->article->user->points -= $interchange->article->points;
        Auth::user()->save();
        $interchange->article->user->save();

        $interchange->status = 'canceled';
        $interchange->article->trans = 0;
        $interchange->article->save();
        $interchange->save();
        return back()
            ->with('message', 'Intercambio cancelado, ahora tiene ' . Auth::user()->points . ' puntos.');
    }
}
