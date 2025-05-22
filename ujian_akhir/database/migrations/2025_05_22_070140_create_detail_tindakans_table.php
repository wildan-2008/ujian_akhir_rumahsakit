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
        Schema::create('detail_tindakans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
    $table->foreignId('tindakan_id')->constrained('tindakans')->onDelete('cascade');
    $table->string('keterangan')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__tindakans');
    }
};
