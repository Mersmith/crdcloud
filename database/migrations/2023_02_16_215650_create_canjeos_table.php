<?php

use App\Models\Canjeo;
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
        Schema::create('canjeos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('odontologo_id')->nullable();
            $table->unsignedBigInteger('clinica_id')->nullable();

            $table->enum('estado', [Canjeo::PENDIENTE, Canjeo::APLICADO, Canjeo::ANULADO])->default(Canjeo::PENDIENTE);
            $table->float('total_puntos');
            $table->string('puntos_usados')->nullable();
            $table->string('link')->unique();
            $table->text('observacion')->nullable();
            $table->integer('descargas')->default(0);

            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('odontologo_id')->references('id')->on('odontologos')->onDelete('cascade');
            $table->foreign('clinica_id')->references('id')->on('clinicas')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canjeos');
    }
};
