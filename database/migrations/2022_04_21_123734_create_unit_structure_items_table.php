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
        Schema::create('unit_structure_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unit_name_structure_id')->unsigned();
            $table->string('name', 100);
            $table->text('description');
            $table->text('photo');
            $table->timestamps();

            $table->foreign('unit_name_structure_id')->references('id')->on('unit_name_structures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_structure_items');
    }
};
