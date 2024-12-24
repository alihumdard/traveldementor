<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('country_id');
            $table->string('plan_type');
            $table->string('s_date');
            $table->string('e_date');
            $table->string('policy_no');
            $table->string('payment_mode')->nullable();
            $table->string('sale_date');
            $table->string('amount')->nullable();
            $table->string('payable_after_40_per')->nullable();
            $table->string('net_payable');
            $table->string('refund_applied');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
