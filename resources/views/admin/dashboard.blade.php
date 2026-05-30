@extends('layouts.app')
@section('title', 'Painel Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⚙ Painel Administrativo</h2>
    <a href="{{ route('admin.recursos.index') }}" class="btn btn-outline-dark">Gerenciar Recursos</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <strong>Todos os Agendamentos</strong>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-secondary">
                <tr>
                    <th>Usuário</th>
                    <th>Recurso</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $ag)
                <tr>
                    <td>{{ $ag->user->name }}</td>
                    <td>{{ $ag->recurso->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}</td>
                    <td>{{ substr($ag->horario_inicio, 0, 5) }} – {{ substr($ag->horario_fim, 0, 5) }}</td>
                    <td>
                        @php
                            $cores = ['pendente' => 'warning', 'confirmado' => 'success', 'cancelado' => 'danger'];
                        @endphp
                        <span class="badge bg-{{ $cores[$ag->status] }}">
                            {{ ucfirst($ag->status) }}
                        </span>
                    </td>
                    <td>
                        @if($ag->status === 'pendente')
                        <form method="POST" action="{{ route('admin.confirmar', $ag) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">✔ Confirmar</button>
                        </form>
                        <form method="POST" action="{{ route('admin.cancelar', $ag) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Cancelar este agendamento?')">✘ Cancelar</button>
                        </form>
                        @else
                            <span class="text-muted small">–</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Nenhum agendamento cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
