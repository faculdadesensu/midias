<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
       
        $username       = $request->username;
        $password   = $request->password;

        $users      = User::where('username', '=', $username)->where('password', '=', $password)->first();

        if(@$users->name != null){
  
            @session_start();
            $_SESSION['id_user'] = $users->id;
            $_SESSION['user_name'] = $users->name;

            if($_SESSION['level_user'] == 'admin'){
                return view('painel-admin.index');
            }
           
        }else{
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }
    
    public function logout(){
       @session_start();
       @session_destroy();
       return view('index');
    }

    public function delete(User $item){
        $item->delete();
        return redirect()->route('users.index');
     }

    public function modal($id){
        $users = User::orderby('id', 'desc')->paginate();
        return view('painel-admin.user.index', ['users' => $users, 'id' => $id]);
    }

    public function index(){
        $users = User::orderby('id', 'desc')->paginate();
        return view('painel-admin.user.index', ['users' => $users]);
    }
}
