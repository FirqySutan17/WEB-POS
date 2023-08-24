<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->string('receipt_no')->unique();
            $table->string('emp_no');
            $table->date('trans_date');
            $table->string('payment_method')->comment('CASH, EDC - BCA, EDC - QRIS');
            $table->integer('cash')->nullable();
            $table->integer('sub_price');
            $table->integer('vat_ppn');
            $table->integer('total_price');
            $table->string('status')->comment('DRAFT, FINISH, CANCEL');
            $table->text('cancellation_reason')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tr_transaction');
    }
}
