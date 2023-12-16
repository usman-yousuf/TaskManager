<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TaskManagementController;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // get register view
    public function registerView(){
        return view('register');
    }

    // get login view
    public function loginView(){
        return view('login');
    }

    // register and save user data
    public function registerUser(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:12'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();
        if($user->save()){
            return back()->with('success', 'You have successfully registered');
        }
    }

    // login user after regisration 
    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect()->route('task.list')->with('success', 'You have successfully login');
            }
        }

    }

    // logout user
    public function logout(){
        if(session()->has('loginId')){
            session()->pull('loginId');
        }
        return redirect()->route('login.view');
    }
}
