@extends('layouts.app')
@section('title', 'Editar Recurso')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">✏ Editar Recurso</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.recursos.update', $recurso) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome *</label>
                        <input type="text" name="nome" class="form-control"
                            value="{{ old('nome', $recurso->nome) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo *</label>
                        <select name="tipo" class="form-select" required>
                            <option value="sala" {{ old('tipo', $recurso->tipo) == 'sala' ? 'selected' : '' }}>Sala de Estudo</option>
                            <option value="computador" {{ old('tipo', $recurso->tipo) == 'computador' ? 'selected' : '' }}>Computador</option>
                            <option value="atendimento" {{ old('tipo', $recurso->tipo) == 'atendimento' ? 'selected' : '' }}>Atendimento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $recurso->descricao) }}</textarea>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" name="disponivel" class="form-check-input"
                            id="disponivel" {{ old('disponivel', $recurso->disponivel) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponivel">Disponível para agendamento</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('admin.recursos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
