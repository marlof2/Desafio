<?php

namespace App\Services\Papel;

use Illuminate\Http\Response;
use App\Models\Papel;

class PapelService
{
    protected $papel;
    public function __construct(Papel $papel)
    {
        $this->papel = $papel;
    }
    public function index($request)
    {
        if ($request->filled('limit')) {
            if ($request->limit == '-1') {
                $data = $this->papel->get();
            }
        } else {
            $data = $this->papel->paginate(config('app.pageLimit'));
        }


        return response()->json($data, Response::HTTP_OK);
    }
    public function store($request)
    {
        try {
            $dataFrom = $request->all();
            $data = $this->papel->create($dataFrom);
            return response()->json($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível cadastrar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function show($papel)
    {
        if (!$papel) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($papel, Response::HTTP_OK);
    }
    public function update($request, $papel)
    {
        if (!$papel) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        $dataFrom = $request->all();
        try {
            $papel->update($dataFrom);
            return response()->json($papel, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível atualizar', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function destroy($papel)
    {
        if (!$papel) {
            return response()->json(['error' => 'Dados não encontrados'], Response::HTTP_NOT_FOUND);
        }
        try {
            $papel->delete();
            return response()->json(['success' => 'Deletado com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => 'Não foi possível excluir', "error" => $e], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
