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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');             
            $table->string('name');
            $table->float('price',10,3);
            $table->integer('id_category');
            $table->integer('id_brand');             
            $table->unsignedInteger('status')->default(0)->comment('1:sale 0:new');
            $table->integer('sale'); 
            $table->string('company');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
