<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditorUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditor_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('update_id');
            $table->string('current_creditor');
            $table->string('new_creditor');
            $table->string('observations')->nullable();
            $table->timestamps();

            // References
            $table->foreign('update_id')->references('id')->on('updates')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditor_updates');
    }
}
