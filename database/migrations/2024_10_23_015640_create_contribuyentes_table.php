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
        Schema::create('contribuyentes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 255);
            $table->string('documento', 255);
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->string('nombre_completo', 511);
            $table->string('direccion', 255);
            $table->string('telefono', 255);
            $table->string('celular', 255);
            $table->string('email', 255);
            $table->foreignId('usuario_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribuyentes');
    }
};
