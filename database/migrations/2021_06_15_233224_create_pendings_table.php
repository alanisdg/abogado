<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendings', function (Blueprint $table) {
            $table->id();
            $table->string('interview_date')->nullable();
            $table->string('second_date')->nullable();
            $table->string('rut')->nullable();
            $table->string('names')->nullable();
            $table->string('surnames')->nullable();
            $table->string('email')->nullable();
            $table->string('balance_dd')->nullable();
            $table->string('phone')->nullable();
            $table->string('creditor_1')->nullable();
            $table->string('creditor_balance_1')->nullable();
            $table->string('creditor_2')->nullable();
            $table->string('creditor_balance_2')->nullable();
            $table->string('heritage')->nullable();
            $table->string('active_demand')->nullable();
            $table->string('active_demands')->nullable();
            $table->string('demand_1')->nullable();
            $table->string('state_1')->nullable();
            $table->string('demand_2')->nullable();
            $table->string('state_2')->nullable();
            $table->integer('status')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('profession')->nullable();
            $table->string('nationality')->nullable();
            $table->string('commune')->nullable();
            $table->string('region')->nullable();
            $table->text('address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('pendings');
    }
}
