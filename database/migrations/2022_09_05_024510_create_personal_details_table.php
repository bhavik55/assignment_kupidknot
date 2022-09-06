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
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('income')->default('0');
            $table->string('occupation')->nullable();
            $table->string('family')->nullable();
            $table->string('manglik')->nullable();
            $table->string('p_income')->default('0');
            $table->string('p_occupation')->nullable();
            $table->string('p_family')->nullable();
            $table->string('p_manglik')->nullable();
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
        Schema::dropIfExists('personal_details');
    }
};
