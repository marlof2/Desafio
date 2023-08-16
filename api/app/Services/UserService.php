<?php

namespace App\Services;

use Illuminate\Http\Response;
use App\Models\User;

class UserService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index($request)
    {
        $query = $this->user->with('papel');

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
        }

        if ($request->filled('data_inicio')) {
            $query->where('created_at', '>=', $request->data_inicio);
        }
        if ($request->filled('data_fim')) {
            $query->where('created_at', '<=', $request->data_fim);
        }

        if ($request->filled('cpf')) {
            $query->where('cpf', 'like', '%' . $request->cpf . '%');
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }


        $data = $query->orderBy('id', 'desc')->paginate(config('app.pageLimit'));

        return response()->json($data, Response::HTTP_OK);
    }
    public function store($request)
    {
        try {
            $dataFrom = $request->all();
            if (isset($dataFrom['password'])) {
                $dataFrom['password'] = bcrypt($dataFrom['password']);
            }
            $data = $this->user->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function show($id)
    {
        $data = $this->user->with('papel', 'enderecos')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($data, Response::HTTP_OK);
    }
    public function update($request, $id)
    {
        $data = $this->user->find($id);
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
        $data = $this->user->find($id);
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
