<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128)->nullable(false)->unique();
            $table->string('description', 256)->default(null);
            $table->string('full_title', 256)->default(null);
            $table->text('full_description')->default(null);
            $table->string('meta_title', 128)->default(null);
            $table->string('meta_description', 256)->default(null);
            $table->boolean('is_active')->default(false)->nullable(false);
            $table->boolean('is_error')->default(false)->nullable(false);

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
        Schema::dropIfExists('products');
    }
}
