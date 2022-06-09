<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name', 30)->nullable();
            // $table->string('slug', 30);
            $table->integer('order');
            $table->boolean('active');
            // $table->string('price_monthly_id', 255)->collation('utf8_bin');
            // $table->string('price_yearly_id', 255)->collation('utf8_bin');
            $table->string('stripe_product_id', 255)->collation('utf8_bin');
            $table->double('discount', 10, 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
