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
        Schema::create('contribution_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('year_id')->unsigned();
            $table->bigInteger('contribution_id')->unsigned();
            $table->string('name', 255);
            $table->text('description');
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contribution_items');
    }
};
