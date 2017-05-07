<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Category;
use App\Http\Requests;


class CategoryController extends Controller {

    protected $indexPath = '/admin/categories';

    public function __construct() {
      $this->middleware(['auth', 'admin']);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:65',
            'description' => 'required|max:255',
        ]);
    }

    public function index() {
        $context['categories'] = Category::all();
        return view('categories.index', $context);
    }

    public function create() {
        return view('categories.create');
    }

    public function delete($id) {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/categories')
                    ->with('message', 'Categoría eliminada.');
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

        $category = new Category($data);
        $category->save();

        return redirect($this->indexPath)->with('message', 'Categoría creada.');
    }

    public function update($id) {
        $context['category'] = Category::find($id);
        return view('categories.update', $context);
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

        $category = Category::find($id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->is_active = $data['is_active'];
        $category->save();

        return redirect($this->indexPath)->with('message', 'Categoría actualizada.');
    }

}
