<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller {

    protected $indexPath = '/admin/users';

    public function __construct() {
      $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request) {
        $context['users'] = User::search($request->arg)->paginate(10);
        return view('users.index', $context);
    }

    public function delete($id) {
        $user = User::find($id);
        $user->is_active = '0';
        $user->save();
        return redirect('/admin/users')
                    ->with('message', 'Usuario baneado.');
    }

    public function turned($id) {
        $user = User::find($id);
        $user->role = 'admin';
        $user->save();
        return redirect('/admin/users')
                    ->with('message', $user->name. ' ahora es administrador');
    }

    public function disban($id) {
        $user = User::find($id);
        $user->is_active = '1';
        $user->save();
        return redirect('/admin/users')
                    ->with('message', $user->name . ' ha sido activado');
    }
}
