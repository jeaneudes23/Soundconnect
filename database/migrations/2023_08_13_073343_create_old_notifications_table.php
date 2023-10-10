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
        Schema::create('old_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_from')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_to')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('cascade');
        $table->enum('action',  ['like','follow','report','comment','ban']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_notifications');
    }
};
