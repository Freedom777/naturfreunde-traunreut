<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // z.B. "Kampenwand"
            $table->string('slug')->unique(); // z.B. "kampenwand"
            $table->string('emoji')->default('📍');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_locations');
    }
};
