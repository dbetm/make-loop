<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Validator;

class ProfileController extends Controller {

    protected $indexPath = '/users/profile/me';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $context['user'] = Auth::user()->find(Auth::user()->id);
        return view('users.profile.me', $context);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:65',
            'last_name' => 'required|max:65',
            'bio' => 'required|max:255',
            'image' => 'max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);
    }

    public function update($id) {
        $context['user'] = User::find($id);
        return view('users.profile.update', $context);
    }

    public function patchUpdate(Request $request, $id) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $data = $request->all();

        $user = User::find($id);
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->bio = $data['bio'];
        $user->image = $data['image'];
        $user->save();

        return redirect($this->indexPath)->with('message', 'Datos guardados de forma correcta.');
    }

    public function editPass($id) {
        $context['user'] = User::find($id);
        return view('users.profile.updatePass', $context);
    }

    public function patchEditPass(Request $request, $id) {
        $validator = $this->validator($request->all());

        if (!$validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $data = $request->all();
        $user = User::find($id);
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect($this->indexPath)->with('message', 'Contraseña cambiada.');
    }
}
