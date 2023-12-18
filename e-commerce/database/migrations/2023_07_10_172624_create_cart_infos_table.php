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
        Schema::create('cart_infos', function (Blueprint $table) {
            $table->id();
            $table->string('product_title')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('Product_id');
            $table->foreign('Product_id')
              ->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')
              ->references('id')->on('users')->onDelete('cascade');
              $table->unsignedBigInteger('Cart_id');
            $table->foreign('Cart_id')
              ->references('id')->on('carts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_infos');
    }
};
