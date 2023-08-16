<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'logradouro',
        'cep',
    ];

    public  function scopeTodos($query, $request)
    {
        return $query->select('*')->from('enderecos as E')
        ->whereNotExists(function ($q) use ($request) {
            $q->select('endereco_id')
                ->from('user_endereco as UE')
                ->where('UE.user_id', $request->user_id)
                ->whereColumn('UE.endereco_id', 'E.id');
        })->get();
    }
    public  function scopeFiltroLogradouroECep($query, $request)
    {
        return $query->select('*')->from('enderecos as E')
            ->where('E.logradouro', 'LIKE', '%' . $request->logradouro . '%')
            ->where('E.cep', 'LIKE', '%' . $request->cep . '%')
            ->whereNotExists(function ($q) use ($request) {
                $q->select('endereco_id')
                    ->from('user_endereco as UE')
                    ->where('UE.user_id', $request->user_id)
                    ->whereColumn('UE.endereco_id', 'E.id');
            })->get();;
    }
    public  function scopeFiltroLogradouro($query, $request)
    {
        return $query->select('*')->from('enderecos as E')
            ->where('E.logradouro', 'LIKE', '%' . $request->logradouro . '%')
            ->whereNotExists(function ($q) use ($request) {
                $q->select('endereco_id')
                    ->from('user_endereco as UE')
                    ->where('UE.user_id', $request->user_id)
                    ->whereColumn('UE.endereco_id', 'E.id');
            })->get();;
    }
    public  function scopeFiltroCep($query, $request)
    {
        return $query->select('*')->from('enderecos as E')
            ->where('E.cep', 'LIKE', '%' . $request->cep . '%')
            ->whereNotExists(function ($q) use ($request) {
                $q->select('endereco_id')
                    ->from('user_endereco as UE')
                    ->where('UE.user_id', $request->user_id)
                    ->whereColumn('UE.endereco_id', 'E.id');
            })->get();;
    }
}
