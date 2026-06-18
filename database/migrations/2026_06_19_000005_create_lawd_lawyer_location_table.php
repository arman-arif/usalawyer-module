<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lawd_lawyer_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')->constrained('lawd_lawyers')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('lawd_locations')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['lawyer_id', 'location_id']);
        });

        Schema::table('lawd_lawyers', function (Blueprint $table) {
            $table->dropForeign(['location']);
            $table->dropColumn('location');
        });
    }

    public function down(): void
    {
        Schema::table('lawd_lawyers', function (Blueprint $table) {
            $table->foreignId('location')->nullable()->constrained('lawd_locations')->nullOnDelete();
        });

        Schema::dropIfExists('lawd_lawyer_location');
    }
};
