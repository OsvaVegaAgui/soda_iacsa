<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_tiquetes', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('id_ticket'); // FK hacia ticket.id_ticket
            $table->integer('cantidad_impresa');
            $table->string('usuario')->nullable();
            $table->timestamp('fecha_impresion')->useCurrent();
            $table->timestamps();

            $table->foreign('id_ticket')
                  ->references('id_ticket')->on('ticket')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_ticketes');
    }
};
