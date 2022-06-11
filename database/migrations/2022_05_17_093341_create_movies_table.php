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
        Schema::disableForeignKeyConstraints();
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("imdb_id", 10)->nullable()->default(null);
            $table->string("title", 100);
            $table->unsignedSmallInteger("year");
            $table->float("rating")->nullable()->default(null);
            $table->integer("rating_count")->nullable()->default(null);
            $table->string('video', 255);
            $table->foreignIdFor(\App\Models\Genre::class)->nullable()->default(null)->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Image::class)->nullable()->default(null)->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->text("description")->default("");
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
