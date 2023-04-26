<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->integer('index')->nullable()->default(null);
            $table->string('region', 256)->nullable();
            $table->string('city', 256);
            $table->string('street', 256);
            $table->string('house', 256)->nullable();
            $table->integer('floor')->nullable()->default(null);
            $table->integer('entrance')->nullable()->default(null);
            $table->integer('flat')->nullable()->default(null);
            $table->boolean('is_private_house')->default(false);
            $table->boolean('is_main')->default(false);

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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
        Schema::dropIfExists('addresses');
    }
}
