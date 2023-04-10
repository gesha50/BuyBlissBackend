<?php

use App\Models\ProductCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256)->nullable(false)->default('-')->unique();
            $table->string('slug', 256)->nullable(false)->default('-')->unique();
            $table->string('img', 256)->nullable()->default(null);
            $table->float('level', 1,0)->default(0);
            $table->foreignIdFor(ProductCategory::class)->default(0);

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
        Schema::dropIfExists('product_categories');
    }
}
