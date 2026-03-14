<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->default('other'); // wanderung, sport, umwelt, gemeinschaft, other
            $table->datetime('starts_at');
            $table->datetime('ends_at')->nullable();
            $table->boolean('all_day')->default(false);
            $table->boolean('guests_welcome')->default(true);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
