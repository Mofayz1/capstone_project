<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chembers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->nullable();
            $table->integer('doctor_id');
            $table->integer('location_id');
            $table->string('start_time', 60)->nullable();
            $table->string('end_time', 60)->nullable();
            $table->string('appoinment', 60)->nullable();
            $table->string('email', 60)->nullable();
            $table->tinyInteger('status')->default(1)->comment('Active : 1 Inactive : 2');
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
        Schema::dropIfExists('chembers');
    }
}
