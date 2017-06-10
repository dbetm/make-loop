<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Article;
use App\Category;

class ArticleController extends Controller {

    protected $indexPath = '/articles/index';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $context['articles'] = Article::where('user_id', $user = Auth::user()->id)->get();
        return view('articles.index', $context);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:65',
            'description' => 'required|max:255',
            'price' => 'min:0.1|max:100000',
            'points' => 'min:1|max:100',
            'status' => 'required',
        ]);
    }

    public function create() {
        $categories['categories'] = Category::all();
        return view('articles.create', $categories);
    }

    public function postCreate(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $data = $request->all();
        if (!array_key_exists('is_active', $data)) {
            $data['is_active'] = '0';
        }

        $category_id = $data['category_id'];
        $article = new Article($data);

        $article['user_id'] = Auth::user()->id;
        $article['category_id'] = $category_id;

        $article->save();

        return redirect($this->indexPath)->with('message', 'Artículo creado.');
    }

    public function turned($id) {
        $article = Article::find($id);
        if($article->is_active == '0') {
            $article->is_active = '1';
            $mess = "Artículo publicado.";
        }
        else {
            $article->is_active = '0';
            $mess = "El artículo ya no es visible para los demás.";
        }

        $article->save();
        return redirect('/articles/index')
                    ->with('message', $mess);
    }

    public function delete($id) {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles/index')
                    ->with('message', 'Artículo eliminado.');
    }

    public function update($id) {
        $context['article'] = article::find($id);
        $categories['categories'] = Category::all();
        return view('articles.update', $context, $categories);
    }

    public function patchUpdate(Request $request, $id) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $data = $request->all();
        if (!array_key_exists('is_active', $data)) {
            $data['is_active'] = '0';
        }

        $article = Article::find($id);
        $article->name = $data['name'];
        $article->status = $data['status'];
        $article->category_id = $data['category_id'];
        $article->points = $data['points'];
        $article->price = $data['price'];
        $article->description = $data['description'];
        $article->image = $data['image'];
        $article->is_active = $data['is_active'];

        $article->save();

        return redirect($this->indexPath)->with('message', 'Artículo actualizado.');
    }
}
