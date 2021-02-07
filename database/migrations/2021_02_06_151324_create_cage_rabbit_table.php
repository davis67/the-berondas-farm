<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCageRabbitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cage_rabbit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cage_id')->index();
            $table->unsignedBigInteger('rabbit_id')->index();
            $table->date('date_of_transfer');
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
        Schema::dropIfExists('cage_rabbit');
    }
}
