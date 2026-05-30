@extends('layouts.app')
@section('title', 'Gerenciar Recursos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📦 Recursos da Biblioteca</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.recursos.create') }}" class="btn btn-primary">+ Novo Recurso</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Painel</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Disponível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recursos as $recurso)
                <tr>
                    <td>{{ $recurso->id }}</td>
                    <td>{{ $recurso->nome }}</td>
                    <td>{{ ucfirst($recurso->tipo) }}</td>
                    <td>{{ $recurso->descricao ?? '–' }}</td>
                    <td>
                        @if($recurso->disponivel)
                            <span class="badge bg-success">Sim</span>
                        @else
                            <span class="badge bg-secondary">Não</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.recursos.edit', $recurso) }}"
                            class="btn btn-sm btn-outline-primary">Editar</a>
                        <form method="POST" action="{{ route('admin.recursos.destroy', $recurso) }}"
                            class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Remover este recurso?')">Remover</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Nenhum recurso cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
