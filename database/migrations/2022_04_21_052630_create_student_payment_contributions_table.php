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
        Schema::create('student_payment_contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contribution_item_id')->unsigned();
            $table->string('user_id', 255);
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('contribution_item_id')->references('id')->on('contribution_items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_payment_contributions');
    }
};
