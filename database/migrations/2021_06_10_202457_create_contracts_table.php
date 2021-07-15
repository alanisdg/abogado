<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('number_contract')->nullable();
            $table->string('annex_code')->nullable();
            $table->string('update_code')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('type_contract');
            $table->unsignedBigInteger('customer_id');
            $table->date('contract_date');
            $table->string('total_contract');
            $table->string('status')->nullable();
            $table->date('first_installment_payment_date')->nullable();
            $table->string('first_payment_amount')->nullable();
            $table->string('number_installments')->nullable();
            $table->string('amount_fees')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
