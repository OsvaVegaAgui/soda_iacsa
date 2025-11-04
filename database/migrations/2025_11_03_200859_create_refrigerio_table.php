<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refrigerio', function (Blueprint $table) {
            $table->integer('id_refrigerio')->autoIncrement();
            $table->string('dia', 15);              
            $table->text('platillo');               
            $table->timestamps();                  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refrigerio');
    }
};
