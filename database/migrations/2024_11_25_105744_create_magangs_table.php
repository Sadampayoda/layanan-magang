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
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis_magang', ['Magang', 'PKL', 'Prakerin']);
            $table->text('description');
            $table->date('rentang_waktu_mulai');
            $table->date('rentang_waktu_selesai');
            $table->date('mulai_pendaftaran');
            $table->date('tutup_pendaftaran');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
