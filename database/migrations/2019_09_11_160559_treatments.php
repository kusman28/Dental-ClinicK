<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Treatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient');
            $table->string('tooth_no')->nullable();
            $table->string('procedure')->nullable();
            $table->string('amount_charge')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('balance')->nullable();
            $table->string('type');
            $table->string('status')->nullable();
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
        //
    }
}
