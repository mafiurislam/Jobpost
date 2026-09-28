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
        Schema::table('job_applications', function (Blueprint $table) {
            $table->date('application_date')->nullable()->after('id');
            $table->string('job_title')->nullable()->after('preferred_location');
            $table->string('connect_preference')->default('WhatsApp')->nullable()->after('experience');
            $table->text('notes')->nullable()->after('connect_preference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['application_date', 'job_title', 'connect_preference', 'notes']);
        });
    }
};
