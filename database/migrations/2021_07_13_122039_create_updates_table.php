<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->integer('type');
            // Change creditor
            $table->unsignedBigInteger('creditor_id')->nullable();
            // Account holder change
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('holder_amount')->nullable();
            // Change strategy
            $table->string('contract_amount')->nullable();
            $table->integer('number_installments')->nullable();
            $table->string('amount_fees')->nullable();
            $table->date('payment_date_installment')->nullable();
            // Change payment date
            $table->date('change_payment_date')->nullable();
            //Deseaced
            $table->string('deceased_new_payment_amount')->nullable();
            $table->integer('deceased_amount_fees')->nullable();
            $table->string('deceased_quota_amount')->nullable();
            $table->date('deceased_new_payment_date')->nullable();
            // General
            $table->string('observations')->nullable();
            $table->timestamps();

            // References
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('updates');
    }
}
