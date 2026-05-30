<?php

namespace Database\Seeders;

use App\Models\Recurso;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário admin de teste
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@biblioteca.com',
            'password' => Hash::make('password'),
            'admin'    => true,
        ]);

        // Criar usuário comum de teste
        User::create([
            'name'     => 'Usuário Teste',
            'email'    => 'usuario@biblioteca.com',
            'password' => Hash::make('password'),
            'admin'    => false,
        ]);

        // Criar recursos de exemplo
        Recurso::create(['nome' => 'Sala de Estudo A', 'tipo' => 'sala',       'descricao' => 'Sala com capacidade para 4 pessoas', 'disponivel' => true]);
        Recurso::create(['nome' => 'Sala de Estudo B', 'tipo' => 'sala',       'descricao' => 'Sala com capacidade para 8 pessoas', 'disponivel' => true]);
        Recurso::create(['nome' => 'Computador 01',    'tipo' => 'computador', 'descricao' => 'PC com acesso à internet',           'disponivel' => true]);
        Recurso::create(['nome' => 'Computador 02',    'tipo' => 'computador', 'descricao' => 'PC com acesso à internet',           'disponivel' => true]);
        Recurso::create(['nome' => 'Atendimento',      'tipo' => 'atendimento','descricao' => 'Horário de atendimento com bibliotecário', 'disponivel' => true]);
    }
}
