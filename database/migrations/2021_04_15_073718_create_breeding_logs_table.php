<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeding_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sire_id')->index();
            $table->unsignedBigInteger('farm_id')->index()->nullable();
            $table->unsignedBigInteger('dam_id')->index();
            $table->date('date_of_mating');
            $table->date('expected_kiddle_date');
            $table->date('kiddle_date')->nullable();
            $table->boolean('is_successful_mating')->default(false);
            $table->integer('litters')->nullable();
            $table->integer('dead_litters')->nullable();
            $table->integer('doe_litters')->nullable();
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
        Schema::dropIfExists('breeding_logs');
    }
}
