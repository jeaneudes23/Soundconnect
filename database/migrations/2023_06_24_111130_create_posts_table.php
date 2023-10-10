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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('community_id')->nullable()->constrained('communities')->onDelete('cascade');
            $table->text('caption');
            $table->string('audio_file')->nullable();
            $table->string('tags')->nullable();
            $table->string('genre')->nullable();
            $table->enum('type', ['text','song','instrumental', 'vocal'])->default('text');
            $table->enum('license', ['free', 'premium'])->nullable()->default('free');
            $table->integer('bpm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
