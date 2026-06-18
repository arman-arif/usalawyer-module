<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lawd_lawyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->json('practice_areas')->nullable();
            $table->foreignId('location')->nullable()->constrained('lawd_locations')->nullOnDelete();
            $table->text('address')->nullable();
            $table->longText('about_overview')->nullable();
            $table->string('contact_number', 32)->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('website_url')->nullable();
            $table->date('featured_date_setup')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lawd_lawyers');
    }
};
