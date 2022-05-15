<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
class UserController extends Controller
{
   
    public function index()
    {
        return User::where('active', 1)->where('role', 1)->get();
    }

    
    public function create(Request $requset)
    {
        return $request;
    }

    
    public function store(Request $request)
    {
        $user = new User;
        $user->id = Str::uuid()->toString();
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->account = $request->account;
        $user->password= "123";
        $user->role = 1;
        $user->active = 1;
        $user->save();
        return $user;
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->account = $request->account;
        $user->save();
        return $user;
    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return $user;
    }
}
