<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecoRequest;
use App\Services\Endereco\EnderecoService;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{

    protected $endereco_service;
    public function __construct(EnderecoService $endereco_service)
    {
        $this->endereco_service = $endereco_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->endereco_service->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnderecoRequest $request)
    {
        return $this->endereco_service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->endereco_service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEnderecoRequest $request, $id)
    {
        return $this->endereco_service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->endereco_service->destroy($id);
    }
}
