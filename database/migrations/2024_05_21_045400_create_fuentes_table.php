<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyecto')
            ->nullable()
            ->constrained('proyectos')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->foreignId('id_objetivo')
            ->nullable()
            ->constrained('objetivos')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->foreignId('id_resultado')
            ->nullable()
            ->constrained('resultados')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->foreignId('id_actividicador')
            ->nullable()
            ->constrained('actividicadores')
            ->cascadeOnUpdate()
            ->restrictOnDelete();      
            $table->string('nombre');
            $table->string('detalle');
            $table->string('procedencia');
            $table->string('tipo');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuentes');
    }
};
