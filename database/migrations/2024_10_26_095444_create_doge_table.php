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
        Schema::create('doge', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama', 100);
            $table->date('dob');
            $table->string('trait', 100);
            $table->string('jenis_kelamin', 10);
            $table->string('keterangan')->nullable();
            $table->string('vaccin_status')->nullable();
            $table->string('img_route')->nullable();
            $table->enum('adoption_status', ['available', 'pending', 'adopted'])->default('available');
            $table->string('pesan_adopsi')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doge');
    }
};
