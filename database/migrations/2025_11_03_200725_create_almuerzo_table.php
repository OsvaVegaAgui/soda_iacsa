<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('almuerzo', function (Blueprint $table) {
            $table->integer('id_almuerzo')->autoIncrement();
            $table->string('dia', 15);            
            $table->text('platillo');             
            $table->timestamps();                 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('almuerzo');
    }
};
