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
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('owner');
            $table->string('contact');
            $table->string('location');

            // Operations
            $table->integer('capacity')->default(0);
            $table->integer('current_occupancy')->default(0);

            // Trust and verification
            $table->boolean('is_verified')->default(false);

            // Optional improvements
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();

            // Ownership
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
