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
        Schema::create('d_s160_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('category_id');
            $table->string('reservation_id')->nullable();
            $table->string('ds160')->nullable();
            $table->string('revised_ds160')->nullable();
            $table->string('f_five_surname')->nullable();
            $table->string('year_of_birth')->nullable();
            $table->string('s_question')->nullable();
            $table->string('s_answer')->nullable();
            $table->string('us_travel_doc_email')->nullable();
            $table->string('us_travel_doc_password')->nullable();
            $table->string('us_travel_doc_updated_password')->nullable();
            $table->string('challan_created')->nullable();
            $table->string('challan_submitted')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('appoint_date')->nullable();
            $table->string('appoint_schedule')->nullable();
            $table->string('pick_up_location')->nullable();
            $table->string('premium_delivery')->nullable();
            $table->string('delivery_address')->nullable();
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
        Schema::dropIfExists('d_s160_s');
    }
};
