<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->nullable();
            $table->string('qualification')->nullable();
            $table->string('present_work')->nullable();
            $table->string('time')->nullable();
            $table->string('appoinment')->nullable();
            $table->string('specialty')->nullable();
            $table->string('designation')->nullable();
            $table->string('institute')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('Active : 1, Inactive : 2');
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
        Schema::dropIfExists('doctors');
    }
}
