<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'disponivel',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
