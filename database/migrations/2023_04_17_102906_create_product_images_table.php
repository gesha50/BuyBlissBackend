<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            $table->string('title', 256)->nullable(false)->default('-')->unique();
            $table->string('img', 256)->nullable()->default(null);
            $table->boolean('is_poster')->default(false)->nullable(false);
            $table->boolean('is_universal')->default(false)->nullable(false);

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('color_product_id')->default(null)->nullable();
            $table->foreign('color_product_id')->references('id')->on('color_product')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
