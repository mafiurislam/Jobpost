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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('company')->default('Bright Future Consultancy');
            $table->string('sector_slug')->default('all');
            $table->string('sector_name')->default('General');
            $table->string('location')->default('India & Overseas');
            $table->string('salary')->default('As per industry standards');
            $table->string('qualification')->default('10th, 12th, Graduate Pass');
            $table->string('badge_tag')->default('100% FREE PLACEMENT');
            $table->text('description')->nullable();
            $table->text('duties')->nullable();
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('poster_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
