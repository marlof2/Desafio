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

        if ($request->filled('limit')) {
            if ($request->limit == '-1') {
                $data =  $this->endereco::Todos($request);
            }
        } else if($request->filled('search')){
            $data =  $this->endereco->where('logradouro', 'like', '%' . $request->search . '%')->orWhere('cep', 'like', '%' . $request->search . '%')->paginate(config('app.pageLimit'));
        }
        else {
            $data = $this->endereco->paginate(config('app.pageLimit'));
        }

        if ($request->filled('logradouro') || $request->filled('cep')) {
            if ($request->logradouro && $request->cep) {
                $data =  $this->endereco::FiltroLogradouroECep($request);
                return  response()->json($data, Response::HTTP_OK);
            }
            if ($request->logradouro) {
                $data =  $this->endereco::FiltroLogradouro($request);
                return  response()->json($data, Response::HTTP_OK);
            }
            if ($request->cep) {
                $data =  $this->endereco::FiltroCep($request);
                return  response()->json($data, Response::HTTP_OK);
            }
        }

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
