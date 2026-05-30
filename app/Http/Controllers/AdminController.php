<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;

class AdminController extends Controller
{
    // Painel com todos os agendamentos
    public function index()
    {
        $agendamentos = Agendamento::with(['user', 'recurso'])
            ->orderBy('data', 'desc')
            ->get();

        return view('admin.dashboard', compact('agendamentos'));
    }

    // Confirma um agendamento
    public function confirmar(Agendamento $agendamento)
    {
        $agendamento->update(['status' => 'confirmado']);
        return back()->with('success', 'Agendamento confirmado!');
    }

    // Cancela um agendamento (como admin)
    public function cancelar(Agendamento $agendamento)
    {
        $agendamento->update(['status' => 'cancelado']);
        return back()->with('success', 'Agendamento cancelado!');
    }
}
