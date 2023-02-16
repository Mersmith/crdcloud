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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained('users');
            $table->foreignId('sede_id')->constrained('sedes');
            $table->unsignedBigInteger('odontologo_id')->nullable();
            $table->unsignedBigInteger('clinica_id')->nullable();

            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->unique();
            $table->string('dni')->nullable()->unique();
            $table->string('cop')->nullable()->unique();
            $table->string('celular')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['hombre', 'mujer']);
            $table->integer('puntos')->nullable()->default(0);
            $table->string('rol')->nullable()->default("paciente");

            $table->foreign('odontologo_id')->references('id')->on('odontologos')->onDelete('set null');
            $table->foreign('clinica_id')->references('id')->on('clinicas')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
