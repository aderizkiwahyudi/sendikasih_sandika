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
        Schema::create('teachers', function (Blueprint $table) {
            $table->string('user_id', 255);
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('year_id')->unsigned();
            $table->string('name', 100);
            $table->string('nip', 50)->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday_at')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
