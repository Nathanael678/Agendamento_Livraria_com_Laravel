@extends('layouts.app')
@section('title', 'Meus Agendamentos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Meus Agendamentos</h2>
    <a href="{{ route('agendamentos.create') }}" class="btn btn-primary">+ Novo Agendamento</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Recurso</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $ag)
                <tr>
                    <td>{{ $ag->recurso->nome }}</td>
                    <td>{{ ucfirst($ag->recurso->tipo) }}</td>
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
                        @if($ag->status !== 'cancelado')
                        <form method="POST" action="{{ route('agendamentos.destroy', $ag) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Deseja cancelar este agendamento?')">
                                Cancelar
                            </button>
                        </form>
                        @else
                            <span class="text-muted small">–</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Você ainda não possui agendamentos.
                        <a href="{{ route('agendamentos.create') }}">Faça o primeiro!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
