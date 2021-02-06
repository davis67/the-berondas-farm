<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabbitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabbits', function (Blueprint $table) {
            $table->id();
            $table->string('rabbit_no')->unique();
            $table->unsignedBigInteger('farm_id')->index();
            $table->unsignedBigInteger('mother_id')->index()->nullable();
            $table->unsignedBigInteger('father_id')->index()->nullable();
            $table->string('breed');
            $table->string('gender');
            $table->string('status');
            $table->date('date_of_birth')->nullable();
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
        Schema::dropIfExists('rabbits');
    }
}
