@extends('layouts.app')
@section('title', 'Novo Agendamento')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📅 Novo Agendamento</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('agendamentos.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Recurso *</label>
                        <select name="recurso_id" class="form-select" required>
                            <option value="">Selecione o recurso...</option>
                            @foreach($recursos as $recurso)
                                <option value="{{ $recurso->id }}"
                                    {{ old('recurso_id') == $recurso->id ? 'selected' : '' }}>
                                    {{ $recurso->nome }} – {{ ucfirst($recurso->tipo) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Data *</label>
                        <input type="date" name="data" class="form-control"
                            value="{{ old('data') }}"
                            min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Horário de Início *</label>
                            <input type="time" name="horario_inicio" class="form-control"
                                value="{{ old('horario_inicio') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Horário de Fim *</label>
                            <input type="time" name="horario_fim" class="form-control"
                                value="{{ old('horario_fim') }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Observação (opcional)</label>
                        <textarea name="observacao" class="form-control" rows="3"
                            placeholder="Alguma observação adicional...">{{ old('observacao') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Confirmar Agendamento</button>
                        <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
