<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
       
        $username   = $request->username;
        $password   = $request->password;

        $users      = User::where('username', '=', $username)->where('password', '=', $password)->first();

        if(@$users->name != null){
  
            @session_start();
            $_SESSION['id_user'] = $users->id;
            $_SESSION['user_name'] = $users->name;
            $_SESSION['level'] = $users->level;

            if($_SESSION['level'] == 'admin'){
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
       return view('login.index');
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

    
    public function insert(Request $request){
     
        $tabela              = new User();
       
        $tabela->name        = $request->name;
        $tabela->fone        = $request->fone;

        $check = User::where('name', '=', $request->name)->orwhere('fone', '=', $request->fone)->count();
        if($check > 0){
            echo "<script language='javascript'> window.alert('Já existe um cliente com o Nome ou Telefone informado!') </script>";
            $user_session =  $_SESSION['level_user'];

            if ($user_session == 'admin') {
                return view('painel-admin.cliente.create');
            }else{
                return view('painel-recepcao.cliente.create');
            }
        }

        $tabela->save();
        
        $user_session =  $_SESSION['level_user'];

        if ($user_session == 'admin') {
            return redirect()->route('clientes.index');
        }else{
            return redirect()->route('painel-recepcao-clientes.index');
        }
    }

    public function edit(User $item){
       
        $user_session =  $_SESSION['level_user'];

        if ($user_session == 'admin') {
            return view('painel-admin.cliente.edit', ['item' => $item]);
        }else{
            return view('painel-recepcao.cliente.edit', ['item' => $item]);
        }  
    }

    public function editar(Request $request, User $item){

        $item->name     = $request->name;
        $item->fone     = $request->fone;
        $oldName        = $request->oldName;
        $oldFone        = $request->oldFone;

        $user_session =  $_SESSION['level_user'];

        if($oldFone != $request->fone){
            $check = User::where('fone', '=', $request->fone)->count();
            if($check > 0){
                echo "<script language='javascript'> window.alert('Cliente já cadastrado. Telefone já cadastrado') </script>";
                if ($user_session == 'admin') {
                    return view('painel-admin.cliente.edit', ['item' => $item]);
                }else{
                    return view('painel-recepcao.cliente.edit', ['item' => $item]);
                } 
            }
        }if ($oldName != $request->name) {
            $check = User::where('name', '=', $request->name)->count();
            if($check > 0){
                echo "<script language='javascript'> window.alert('Cliente já cadastrado. Email já cadastrado!') </script>";                
                
                if ($user_session == 'admin') {
                    return view('painel-admin.cliente.edit', ['item' => $item]);
                }else{
                    return view('painel-recepcao.cliente.edit', ['item' => $item]);
                } 
            }
        }

        $item->save();
        
        if ($user_session == 'admin') {
            return redirect()->route('clientes.index');
        }else{
            return redirect()->route('painel-recepcao-clientes.index');
        }
    }

}
