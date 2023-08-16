<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEnderecos extends Model
{
    use HasFactory;

    protected $table = 'user_endereco';
    protected $fillable = [
        'user_id',
        'endereco_id',
    ];
}
