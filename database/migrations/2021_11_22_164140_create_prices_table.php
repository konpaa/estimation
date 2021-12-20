<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('currency', ['EUR', 'USD', 'BYN']);
            $table->decimal('value');
            $table->uuid('product_id');
            $table->timestamps();

            $table->foreign('product_id')->on('products')->references('id')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
