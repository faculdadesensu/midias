<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('painel-admin.index');
    }

    public function edit(Request $request, User $user){
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        
        if($request->password != "" && $request->password != null){
            $user->password = sha1($request->password);
        }

        $user->save();
        return redirect()->route('admin.index');
    }
}
