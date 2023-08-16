<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Services\papel\PapelService;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    protected $papel_service;
    public function __construct(PapelService $papel_service)
    {
        $this->papel_service = $papel_service;
    }
    public function index(Request $request)
    {
        return $this->papel_service->index($request);
    }


    public function store(Request $request)
    {
        return $this->papel_service->store($request);
    }


    public function show(Papel $papel)
    {
        return $this->papel_service->show($papel);
    }


    public function update(Request $request, Papel $papel)
    {
        return $this->papel_service->update($request, $papel);
    }


    public function destroy(Papel $papel)
    {
        return $this->papel_service->destroy($papel);
    }
}
