<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recurso_id')->constrained()->onDelete('cascade');
            $table->date('data');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->enum('status', ['pendente', 'confirmado', 'cancelado'])->default('pendente');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
