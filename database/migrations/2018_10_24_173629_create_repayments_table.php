<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->char('loan_id', 36);
            $table->date('duration_end_date');
            $table->bigInteger('repayment_amount')->default(0);
            $table->bigInteger('repayment_frequency')->default(0);
            $table->bigInteger('repayment_received')->default(0);
            $table->boolean('repayment_full_paid')->default(0);
            $table->bigInteger('paternity_leave_amount')->default(0);
            $table->timestamps();
            $table->primary('id');
            $table->foreign('loan_id')->references('id')->on('loans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repayments');
    }
}
