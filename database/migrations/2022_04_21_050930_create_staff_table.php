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
        Schema::create('staff', function (Blueprint $table) {
            $table->string('user_id', 255);
            $table->bigInteger('status_id')->unsigned();
            $table->string('name', 100);
            $table->string('nip', 50)->nullable();
            $table->string('gender');
            $table->string('birthday_at');
            $table->date('birthday');
            $table->string('address');
            $table->string('description')->nullable();
            $table->string('phone', 20);
            $table->string('photo');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
