<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('nasabah_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->string('jenis_sampah')->default('Campuran');
            $table->string('item_sampah')->nullable();
            $table->float('berat')->default(0);
            $table->decimal('harga_per_kg', 10, 2)->default(1000);
            $table->decimal('total', 12, 2)->default(0);
            $table->unsignedTinyInteger('persentase_nasabah')->default(50);
            $table->decimal('bagi_hasil_nasabah', 12, 2)->default(0);
            $table->decimal('bagi_hasil_pengelola', 12, 2)->default(0);
            $table->decimal('poin', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
