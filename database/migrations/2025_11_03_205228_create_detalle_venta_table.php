<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();

            $table->integer('venta_id');
            $table->foreign('venta_id')
                  ->references('id')->on('ventas')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            
            $table->string('codigo', 50)->unique();

            $table->integer('cantidad_vendida');        
            $table->decimal('precio_unitario', 10, 2);  
            $table->decimal('subtotal', 10, 2); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};
