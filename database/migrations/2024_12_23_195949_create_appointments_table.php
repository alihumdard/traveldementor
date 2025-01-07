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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('vfs_embassy_id');
            $table->unsignedBigInteger('category_id');
            $table->string('no_application');
            $table->string('appointment_type');
            $table->string('applicant_contact')->nullable();
            $table->string('appointment_email')->nullable();
            $table->string('appointment_contact_no')->nullable();
            $table->string('vfs_appointment_refers')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('bio_metric_appointment_date')->nullable();
            $table->string('appointment_reschedule')->nullable();
            $table->string('appointment_refer_no')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
