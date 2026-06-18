<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lawd_lawyer_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('lawd_lawyers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('lawd_categories')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['lawyer_id', 'category_id']);
        });

        Schema::create('lawd_lawyer_sub_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('lawd_lawyers')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('lawd_sub_categories')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['lawyer_id', 'sub_category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lawd_lawyer_sub_category');
        Schema::dropIfExists('lawd_lawyer_category');
    }
};
