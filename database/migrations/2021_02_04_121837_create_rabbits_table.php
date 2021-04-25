<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('dam_id')->index()->nullable();
            $table->unsignedBigInteger('sire_id')->index()->nullable();
            $table->unsignedBigInteger('cage_id')->index()->nullable();
            $table->unsignedBigInteger('breed_id')->index()->nullable();
            $table->string('weight')->nullable();
            $table->string('description')->nullable();
            $table->string('gender')->default('unknown');
            $table->string('status')->default('alive');
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
