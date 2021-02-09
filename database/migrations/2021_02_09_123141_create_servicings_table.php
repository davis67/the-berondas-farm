<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mother_id')->index();
            $table->unsignedBigInteger('farm_id')->index()->nullable();
            $table->unsignedBigInteger('father_id')->index();
            $table->date('date_of_servicing');
            $table->date('expected_date_of_birth');
            $table->date('actual_date_of_birth')->nullable();
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
        Schema::dropIfExists('servicing');
    }
}
