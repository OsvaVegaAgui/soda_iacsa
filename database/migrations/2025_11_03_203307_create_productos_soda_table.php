<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos_soda', function (Blueprint $table) {
            $table->integer('id_producto_soda')->autoIncrement();          
            $table->string('nombre', 100);             
            $table->string('codigo_softland', 50)->nullable()->unique();
            $table->string('codigo_barras', 50)->nullable()->unique();
            $table->decimal('precio', 10, 2);       
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_soda');
    }
};
