<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    // Lista os agendamentos do usuário logado
    public function index()
    {
        $agendamentos = Agendamento::where('user_id', Auth::id())
            ->with('recurso')
            ->orderBy('data', 'desc')
            ->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    // Exibe o formulário de novo agendamento
    public function create()
    {
        $recursos = Recurso::where('disponivel', true)->get();
        return view('agendamentos.create', compact('recursos'));
    }

    // Salva o agendamento
    public function store(Request $request)
    {
        $request->validate([
            'recurso_id'     => 'required|exists:recursos,id',
            'data'           => 'required|date|after_or_equal:today',
            'horario_inicio' => 'required',
            'horario_fim'    => 'required|after:horario_inicio',
        ]);

        // Verificar conflito de horário
        $conflito = Agendamento::where('recurso_id', $request->recurso_id)
            ->where('data', $request->data)
            ->where('status', '!=', 'cancelado')
            ->where(function ($query) use ($request) {
                $query->whereBetween('horario_inicio', [$request->horario_inicio, $request->horario_fim])
                      ->orWhereBetween('horario_fim', [$request->horario_inicio, $request->horario_fim]);
            })->exists();

        if ($conflito) {
            return back()->withErrors(['horario' => 'Já existe um agendamento neste horário para este recurso!']);
        }

        Agendamento::create([
            'user_id'        => Auth::id(),
            'recurso_id'     => $request->recurso_id,
            'data'           => $request->data,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim'    => $request->horario_fim,
            'observacao'     => $request->observacao,
            'status'         => 'pendente',
        ]);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento realizado com sucesso!');
    }

    // Cancela o agendamento
    public function destroy(Agendamento $agendamento)
    {
        if ($agendamento->user_id !== Auth::id()) {
            abort(403);
        }

        $agendamento->update(['status' => 'cancelado']);

        return back()->with('success', 'Agendamento cancelado com sucesso.');
    }
}
