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
        Schema::create('page_files', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->bigInteger('unit_id')->unsigned();
            $table->string('title', 255);
            $table->string('description');
            $table->string('slug');
            $table->string('url');
            $table->string('year', 5)->nullable();
            $table->string('category');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_files');
    }
};
