<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->nullable();
            $table->tinyInteger('type')->default(1)->comment('Banner: 1 Script: 2');
            $table->string('size', 40)->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('image')->nullable();
            $table->text('script')->nullable();
            $table->tinyInteger('status')->default(1)->comment('enabled : 1, disable : 2');
            $table->integer('impression')->default(0);
            $table->integer('click')->default(0);
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
        Schema::dropIfExists('advertises');
    }
}
