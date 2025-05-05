<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_minima')->default(10);
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad_por_paquete')->nullable();
            $table->decimal('precio_por_paquete', 10, 2)->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('proveedor')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->enum('estado', ['Disponible', 'Bajo Stock', 'Agotado'])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};