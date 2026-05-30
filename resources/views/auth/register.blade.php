@extends('layouts.app')
@section('title', 'Cadastro')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0">📚 Cadastro – Biblioteca</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome completo</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Cadastrar</button>
                </form>
                <hr>
                <p class="text-center mb-0">
                    Já tem conta? <a href="{{ route('login') }}">Faça login</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
