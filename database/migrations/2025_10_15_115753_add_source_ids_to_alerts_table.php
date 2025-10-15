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
        Schema::table('alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('application_id')->nullable()->after('client_id');
            $table->unsignedBigInteger('appointment_id')->nullable()->after('application_id');
            $table->unsignedBigInteger('hotel_booking_id')->nullable()->after('appointment_id');
            $table->unsignedBigInteger('insurance_id')->nullable()->after('hotel_booking_id');
            $table->unsignedBigInteger('ds160_id')->nullable()->after('insurance_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropColumn([
                'application_id',
                'appointment_id',
                'hotel_booking_id',
                'insurance_id',
                'ds160_id'
            ]);
        });
    }
};