<?php

use App\Models\Venta;
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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('odontologo_id')->nullable();

            $table->enum('estado', [Venta::PENDIENTE, Venta::PAGADO, Venta::ANULADO])->default(Venta::PENDIENTE);
            $table->float('total');
            $table->string('puntos_ganados')->nullable();
            $table->string('link')->nullable();
            $table->text('observacion')->nullable();
            $table->integer('descargas_imagen')->default(0);
            $table->integer('descargas_link')->default(0);
            $table->integer('descargas_informe')->default(0);

            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('odontologo_id')->references('id')->on('odontologos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
