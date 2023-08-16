<?php

namespace App\Services\Endereco;

use Illuminate\Http\Response;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;

class EnderecoService
{
    protected $endereco;
    public function __construct(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }
    public function index($request)
    {

        if ($request->filled('limit') || $request->filled('logradouro') || $request->filled('cep')) {
            if ($request->limit == '-1') {
              return  $data =  $this->endereco::Search($request);
            }
        }

        if($request->filled('search')){
            return $data =  $this->endereco->where('logradouro', 'like', '%' . $request->search . '%')->paginate(config('app.pageLimit'));
        }

        return $data = $this->endereco->paginate(config('app.pageLimit'));
        return response()->json($data, Response::HTTP_OK);
    }
    public function store($request)
    {
        try {
            $dataFrom = $request->all();
            $data = $this->endereco->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function show($id)
    {
        $data = $this->endereco->find($id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($data, Response::HTTP_OK);
    }
    public function update($request, $id)
    {
        $data = $this->endereco->find($id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        $dataFrom = $request->all();
        try {
            $data->update($dataFrom);
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível atualizar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function destroy($id)
    {
        $data = $this->endereco->find($id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        try {
            $data->delete();
            return response()->json(['success' => 'Deletado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível excluir', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
