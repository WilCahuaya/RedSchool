<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles=Role::all();
        $users=User::all();
        return view('users.index', compact('users','roles'));
    }

    public function edit($id){
        $roles=Role::all();
        $user=User::find($id);
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            // 'role'=>'required',
        ]);
        $user=User::find($id);
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->roles_id=$request->get('role');
        $user->save();

        return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente');

    }

    public function create(){
        $roles=Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password',
        ]);
        $user = new User();
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password= Hash::make($request->get('password'));
        $user->roles_id=$request->get('role');
        $user->save();

        return redirect()->route('user.index')->with('success','Usuario añadido correctamente');
    }
    
    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success','Usuario dado de baja correctamente');
    }
}