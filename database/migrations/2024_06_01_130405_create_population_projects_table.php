<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('population_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyecto')
            ->nullable()
            ->constrained('proyectos')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->foreignId('id_campo')
            ->nullable()
            ->constrained('poblacion_campos')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->bigInteger('id_detalle');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('population_projects');
    }
};