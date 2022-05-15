<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function authenthicate(Request $request){
        if ($request->session()->exists('user_id')) {
            $id = $request->session()->get('user_id');
            return $id;
        }
        return false;
    }

    public function login(Request $request){
        $account = $request->account;
        $password = $request->password;
        $user = User::where('account', $account)->where('password', $password)->first();
        if($user == null)
            return false;
        $request->session()->put('user_id', $user->id);
        $request->session()->put('role', $user->role);
        return true;
    }

    public function redirect(Request $request){
        if ($request->session()->exists('user_id') && $request->session()->exists('role')) {
            $role = $request->session()->get('role');
            if($role == 0)
                return redirect('admin');
            else if($role==1)
                return redirect('admin/product');
            else if($role==2)
                return redirect('/');
        }
        return redirect('login');
    }

    public function loginPage(Request $request){
        if ($request->session()->exists('user_id') && $request->session()->exists('role')) {
            $role = $request->session()->get('role');
            if($role == 0)
                return redirect('admin');
            else if($role==1)
                return redirect('admin/product');
            else if($role==2)
                return redirect('/');
        }
        return view('login');
    }

    public function logout(Request $request){
        $request->session()->forget(['user_id', 'role']);
        return redirect('/');
    }

    public function getUserName(Request $request){
        if ($request->session()->exists('user_id') && $request->session()->exists('role')) {
            $id = $request->session()->get('user_id');
            $user = User::where('active',1)->where('id', $id)->first();
            return $user->fullname;
        }
    }
}
