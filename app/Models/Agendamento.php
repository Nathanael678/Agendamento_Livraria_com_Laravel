<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'user_id',
        'recurso_id',
        'data',
        'horario_inicio',
        'horario_fim',
        'status',
        'observacao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
