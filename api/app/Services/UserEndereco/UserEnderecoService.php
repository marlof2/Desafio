<?php

namespace App\Services\UserEndereco;

use Illuminate\Http\Response;
use App\Models\UserEnderecos;

class UserEnderecoService
{
    protected $user_endereco;
    public function __construct(UserEnderecos $user_endereco)
    {
        $this->user_endereco = $user_endereco;
    }
    public function index($request)
    {
        if ($request->filled('limit')) {
            if ($request->limit == '-1') {
                $data = $this->user_endereco->get();
            }
        } else {
            $data = $this->user_endereco->paginate(config('app.pageLimit'));
        }
        return response()->json($data, Response::HTTP_OK);
    }
    public function store($request)
    {
        try {
            $dataFrom = $request->all();
            $data = $this->user_endereco->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function show($id)
    {
        $data = $this->user_endereco->with('papel','enderecos')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($data, Response::HTTP_OK);
    }
    public function update($request, $id)
    {
        $data = $this->user_endereco->find($id);
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

    public function destroy($request)
    {
        $data = $this->user_endereco->whereEnderecoId($request->endereco_id)->whereUserId($request->user_id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        // dd($data );
        try {
            $data->delete();
            return response()->json(['success' => 'Deletado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível excluir', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
