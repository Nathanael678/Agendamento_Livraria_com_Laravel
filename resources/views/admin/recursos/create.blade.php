@extends('layouts.app')
@section('title', 'Novo Recurso')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">+ Novo Recurso</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.recursos.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome *</label>
                        <input type="text" name="nome" class="form-control"
                            value="{{ old('nome') }}" required placeholder="Ex: Sala de Estudo A">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo *</label>
                        <select name="tipo" class="form-select" required>
                            <option value="">Selecione...</option>
                            <option value="sala" {{ old('tipo') == 'sala' ? 'selected' : '' }}>Sala de Estudo</option>
                            <option value="computador" {{ old('tipo') == 'computador' ? 'selected' : '' }}>Computador</option>
                            <option value="atendimento" {{ old('tipo') == 'atendimento' ? 'selected' : '' }}>Atendimento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"
                            placeholder="Descrição opcional do recurso">{{ old('descricao') }}</textarea>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" name="disponivel" class="form-check-input"
                            id="disponivel" {{ old('disponivel', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponivel">Disponível para agendamento</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{ route('admin.recursos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
