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
        Schema::create('actividicadores', function (Blueprint $table) {
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
            $table->foreignId('id_resultados')
            ->nullable()
            ->constrained('resultados')
            ->cascadeOnUpdate()
            ->restrictOnDelete();      
            $table->string('nombre');
            $table->string('detalle');
            $table->string('procedencia');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividicadores');
    }
};
