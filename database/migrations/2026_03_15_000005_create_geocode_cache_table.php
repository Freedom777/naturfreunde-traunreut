<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geocode_cache', function (Blueprint $table) {
            $table->id();
            $table->decimal('bbox_min_lat', 7, 4);
            $table->decimal('bbox_max_lat', 7, 4);
            $table->decimal('bbox_min_lng', 7, 4);
            $table->decimal('bbox_max_lng', 7, 4);
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->json('nominatim_response')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geocode_cache');
    }
};
