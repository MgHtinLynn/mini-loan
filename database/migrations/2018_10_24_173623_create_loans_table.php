<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->bigInteger('loan_amount')->default(0);
            $table->date('loan_offer_date')->nullable();
            $table->date('loan_verify_date')->nullable();
            $table->tinyInteger('repayment_frequency')->default(0);
            $table->date('duration_start_date')->nullable();
            $table->date('duration_end_date')->nullable();
            $table->string('interest_rate')->default(0);
            $table->bigInteger('arrangement_fees')->default(0);
            $table->bigInteger('total_amount')->default(0);
            $table->boolean('verify')->default(0);
            $table->boolean('full_paid')->default(0);
            $table->char('user_id', 36);
            $table->char('loan_type_id', 36);
            $table->timestamps();
            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('loan_type_id')->references('id')->on('loan_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
