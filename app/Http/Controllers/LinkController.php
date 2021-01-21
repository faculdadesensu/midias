<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function delete(Link $item){
        $item->delete();
        return redirect()->route('links.index');
     }

    public function modal($id){
        $links = Link::orderby('id', 'desc')->paginate();
        return view('painel-admin.links.index', ['links' => $links, 'id' => $id]);
    }

    public function index(){
        
        $links = Link::orderby('id', 'desc')->paginate();
        
        return view('painel-admin.links.index', ['links' => $links]);
    }

    public function create(){
        return view('painel-admin.links.create');
    }


    
    public function insert(Request $request){
     
        $tabela              = new Link();
       
        $tabela->title       = $request->title;
        $tabela->link        = $request->link;
  
        $check = Link::where('link', '=', $request->link)->count();
        if($check > 0){
            echo "<script language='javascript'> window.alert('Já existe cadastro com o link informado!') </script>";
            return view('painel-admin.links.create');
        }

        $tabela->save();
        
        return redirect()->route('links.index');
    }

    public function edit(Link $item){
        return view('painel-admin.links.edit', ['item' => $item]); 
    }

    public function editar(Request $request, Link $item){

        $item->title       = $request->title;
        $item->link        = $request->link;
        $oldLink           = $request->oldLink;
        if($oldLink != $request->link){
            $check = Link::where('link', '=', $request->link)->count();
            if($check > 0){
                echo "<script language='javascript'> window.alert('Link já cadastrado.') </script>";
                return view('painel-admin.links.edit', ['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('links.index');

    }
}