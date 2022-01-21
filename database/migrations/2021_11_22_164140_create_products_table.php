<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->unsignedDecimal('price', 20, 2);
            $table->enum('price_currency', config('currencies.supported_currencies'));

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
