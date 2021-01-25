<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $username   = $request->username;
            $password   = $request->password;

            $users      = User::where('username', '=', $username)->where('password', '=', $password)->first();

            if (@$users->name != null) {

                @session_start();
                $_SESSION['id_user'] = $users->id;
                $_SESSION['user_name'] = $users->name;
                $_SESSION['level'] = $users->level;

                if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'user' ) {
                    return view('painel-admin.index');
                }
            } else {
                echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
                return view('index');
            }
        } catch (\Throwable $th) {
            echo "<script language='javascript'> window.alert('Erro desconhecido!') </script>";
            return view('index');
        }
    }

    public function logout()
    {
        @session_start();
        @session_destroy();
        return view('login.index');
    }

    public function delete(User $item)
    {
        try {
            $item->delete();
            return redirect()->route('users.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function modal($id)
    {
        try {
            $users = User::orderby('id', 'desc')->paginate();
            return view('painel-admin.users.index', ['users' => $users, 'id' => $id]);
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function index()
    {
        try {
            $users = User::orderby('id', 'desc')->paginate();
            return view('painel-admin.users.index', ['users' => $users]);
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function create()
    {
        return view('painel-admin.users.create');
    }

    public function insert(Request $request)
    {
        try {
            $tabela              = new User();

            $tabela->name        = $request->name;
            $tabela->username    = $request->username;
            $tabela->email       = $request->email;
            $tabela->username    = $request->username;
            $tabela->level       = $request->level;
            $tabela->password    = $request->password;

            $check = User::where('username', '=', $request->username)->count();
            if ($check > 0) {
                echo "<script language='javascript'> window.alert('Já existe um cliente com o Nome ou Telefone informado!') </script>";
                return view('painel-admin.users.create');
            }

            $tabela->save();

            return redirect()->route('users.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function edit(User $item)
    {
        return view('painel-admin.users.edit', ['item' => $item]);
    }

    public function editar(Request $request, User $item)
    {
        dd($request);
        try {
            $item->name        = $request->name;
            $item->username    = $request->username;
            $item->email       = $request->email;
            $item->username    = $request->username;
            $item->password    = $request->password;
            $oldUsername       = $request->oldUsername;
 
            if ($oldUsername != $request->username) {
                $check = User::where('username', '=', $request->username)->count();
                if ($check > 0) {
                    echo "<script language='javascript'> window.alert('Cliente já cadastrado. Telefone já cadastrado') </script>";
                    return view('painel-admin.users.edit', ['item' => $item]);
                }
            }

            $item->save();
            return redirect()->route('users.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }
}
