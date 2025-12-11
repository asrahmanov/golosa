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
        Schema::create('tales', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('moral')->nullable(); // Мораль сказки
            $table->text('content')->nullable(); // Текст сказки
            $table->string('audio_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('duration')->default(0); // Длительность в секундах
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('narrator_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('listens')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tales');
    }
};
