<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function delete(Link $item)
    {
        try {
            $item->delete();
            return redirect()->route('links.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function modal($id)
    {

        try {
            $links = Link::orderby('id', 'desc')->paginate();
            return view('painel-admin.links.index', ['links' => $links, 'id' => $id]);
        } catch (\Throwable $th) {
            return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function index()
    {
        try {
            $links = Link::orderby('id', 'desc')->paginate();

            return view('painel-admin.links.index', ['links' => $links]);
        } catch (\Throwable $th) {
            return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function create()
    {
        return view('painel-admin.links.create');
    }

    public function insert(Request $request)
    {
        try {
            $tabela              = new Link();

            $tabela->title       = $request->title;
            $tabela->link        = $request->link;

            $check = Link::where('link', '=', $request->link)->count();
            if ($check > 0) {
                echo "<script language='javascript'> window.alert('Já existe cadastro com o link informado!') </script>";
                return view('painel-admin.links.create');
            }

            $tabela->save();

            return redirect()->route('links.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'title'")) {
                return redirect()->route('links.insert')->with('error', utf8_encode('Título muito Extenso! Utilize no máximo 45 caracteres.'));
            } else if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'link'")) {
                return redirect()->route('links.insert')->with('error', utf8_encode('Link muito Extenso! Peça à administração aumentar o limite permitido.'));
            } else {
                return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
            }
        }
    }

    public function edit(Link $item)
    {
        return view('painel-admin.links.edit', ['item' => $item]);
    }

    public function editar(Request $request, Link $item)
    {
        try {
            $item->title       = $request->title;
            $item->link        = $request->link;
            $oldLink           = $request->oldLink;
            if ($oldLink != $request->link) {
                $check = Link::where('link', '=', $request->link)->count();
                if ($check > 0) {
                    echo "<script language='javascript'> window.alert('Link já cadastrado.') </script>";
                    return view('painel-admin.links.edit', ['item' => $item]);
                }
            }

            $item->save();
            return redirect()->route('links.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'title'")) {
                return redirect()->route('links.edit', ['item' => $item])->with('error', utf8_encode('Título muito Extenso! Utilize no máximo 45 caracteres.'));
            } else if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'link'")) {
                return redirect()->route('links.edit', ['item' => $item])->with('error', utf8_encode('Link muito Extenso! Peça à administração aumentar o limite permitido.'));
            } else {
                return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
            }
        }
    }
}
