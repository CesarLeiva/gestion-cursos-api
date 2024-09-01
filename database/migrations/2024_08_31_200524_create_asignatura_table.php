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
        Schema::create('asignatura', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura');
    }
};
//? Esta es una migración creada con el comando php artisan make:migratin create_asignatura_table, que sirve para crear una tabla en la base de datos
//? Para ejecutar esta migración y que se cree la tabla se usa el comando php artisan migrate
