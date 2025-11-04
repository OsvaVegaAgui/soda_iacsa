<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos_cocina', function (Blueprint $table) {
            $table->integer('id_producto_cocina')->autoIncrement();
            $table->string('nombre_producto_cocina', 100);
            $table->string('codigo', 50)->unique();
            $table->integer('cantidad_hecha');          
            $table->decimal('precio_producto_cocina', 10, 2);  
            $table->integer('categoria_institucion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_cocina');
    }
};
