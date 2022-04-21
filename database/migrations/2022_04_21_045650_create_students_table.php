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
        Schema::create('students', function (Blueprint $table) {
            $table->string('user_id', 255);
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('year_id')->unsigned();
            $table->string('name', 100);
            $table->string('nisn', 50)->nullable();
            $table->string('gender', 20);
            $table->string('birthday_at', 150);
            $table->date('birthday');
            $table->string('address');
            $table->string('previous_school', 255)->nullable();
            $table->string('previous_school_address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('father_name', 100);
            $table->string('father_job', 255);
            $table->string('mother_name', 100);
            $table->string('mother_job', 255);
            $table->string('parents_address');
            $table->string('parents_phone');
            $table->string('photo');
            $table->string('kk')->nullable();
            $table->string('ijazah')->nullable();
            $table->integer('student_status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
};
