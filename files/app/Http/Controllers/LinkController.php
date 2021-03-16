<?php

namespace App\Http\Controllers;

use App\Models\AccessLink;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function delete(Link $item)
    {
        try {
            $item->inactive = true;
            $item->index = null;
            $item->save();

            $this->atualizaIndex();

            return redirect()->route('links.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function modal($id)
    {
        try {
            $links = Link::orderby('index', 'asc')->where('inactive', '=', 0)->get();
            return view('painel-admin.links.index', ['links' => $links, 'id' => $id]);
        } catch (\Throwable $th) {
            return redirect()->route('links.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function index()
    {
        try {
            $links = Link::orderby('index', 'asc')->where('inactive', '=', 0)->get();

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
            $tabela->inactive    = false;

            // Carrega os registros com o mesmo link cadastrado.
            $links = Link::where('link', '=', $request->link)->get();
            // Verifica se retornou algum link.
            if ($links->count() > 0) {
                // Caso o registro já cadastrado com o mesmo link esteja inativo, ativa ele.
                if ($links[0]->inactive) {

                    $links[0]->title = $tabela->title;
                    $links[0]->inactive = false;
                    $links[0]->save();

                    return redirect()->route('links.index')->with('success', utf8_encode('Esse link foi recuperado por já ter sido utilizado anteriormente.'));
                }
                // Caso o registro já cadastrado com o mesmo link não esteja inativo, informa que o registro já existe.
                else {
                    return redirect()->route('links.index')->with('error', utf8_encode('Já existe cadastro com o link informado!'));
                }
            }

            $tabela->save();
            $this->atualizaIndex();

            return redirect()->route('links.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'title'")) {
                return redirect()->route('links.inserir')->with('error', utf8_encode('Título muito Extenso! Utilize no máximo 45 caracteres.'));
            } else if (str_contains($th->getMessage(), "truncated: 1406 Data too long for column 'link'")) {
                return redirect()->route('links.inserir')->with('error', utf8_encode('Link muito Extenso! Peça à administração aumentar o limite permitido.'));
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

    public function reorder(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->data as $data) {
                Link::where('id', $data[1])->update(array('index' => $data[0]));
            }

            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Operação realizada com sucesso.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'error', 'msg' => 'Erro desconhecido!']);
        }
    }

    public function atualizaIndex()
    {
        try {
            DB::beginTransaction();
            $links = Link::orderby('index', 'asc')->where('inactive', '=', 0)->get();

            $count = 1;
            foreach ($links as $link) {
                Link::where('id', $link->id)->update(array('index' => $count));
                $count++;
            }

            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Operação realizada com sucesso.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'error', 'msg' => 'Erro desconhecido!']);
        }
    }

    public function count(Request $request)
    {
        try {
            $data = $request->all();

            // Consulta a contagem da data atual.
            $accessLink = AccessLink::where('id_link', '=', $data['id_link'])->where('date', '=', date('Y-m-d'))->first();

            // Se já existe um registro com a data atual, soma +1 a contagem.
            if ($accessLink) {
                $accessLink->count += 1;
                $accessLink->save();
                return response()->json('Registro atualizado');
            }
            // Se ainda não existe um registro com a data atual, cria um.
            else {
                $accessLink = new AccessLink;
                $accessLink->id_link = $data['id_link'];
                $accessLink->date = date('Y-m-d');
                $accessLink->count = 1;

                $accessLink->save();
                return response()->json('Registro criado');
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function filter_rel(Request $request)
    {
        try {

            $listIdLink = $request->listIdLink;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $listAccessLinkAux = AccessLink::select('access_links.*', 'links.title')->whereIn('id_link', $listIdLink)->whereBetween('date', [$startDate, $endDate])->join('links', 'links.id', '=', 'access_links.id_link')->orderBy('id_link')->orderBy('date')->get();

            $startDate = date_create($startDate);
            $endDate = date_create($endDate);

            // Monta uma lista com todas as datas que serão utilizadas no relatório.
            $listDate = [];
            for ($dataAux = $startDate; $dataAux != $endDate;) {
                $dataAux = $dataAux->modify('+1 day');
                array_push($listDate, $dataAux->format('d/m/Y'));
            }

            // Preenche a lista de dados que será utilizada para a montagem do seu site.
            $listAccessLink = [];
            foreach ($listAccessLinkAux as $accessLink) {
                $accessLink->date = date_format(date_create($accessLink->date), 'd/m/Y');

                if (!isset($listAccessLink[$accessLink->title])) {
                    $listAccessLink[$accessLink->title] = $listDate;
                }

                $index = array_search($accessLink->date, $listAccessLink[$accessLink->title]);
                $listAccessLink[$accessLink->title][$index] = $accessLink->count;
            }

            foreach ($listAccessLink as $accessLink) {
                for ($i=0; $i < count($accessLink); $i++) { 
                    if(is_string($accessLink[$i])){
                        return response()->json('teste');
                        $accessLink[$i] = 0;
                    }
                }
            }

            // Monta o objeto para retornar à tela
            $results = ['listDate' => $listDate, 'listAccessLink' => $listAccessLink];

            return response()->json($results);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
