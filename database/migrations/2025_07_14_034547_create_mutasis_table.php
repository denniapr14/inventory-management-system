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
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_mutasi', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();

            // User relationship
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // ProdukLokasi relationship
            $table->foreignId('produk_lokasi_id')
                ->constrained('produk_lokasi') // Explicitly specify table name
                ->cascadeOnDelete();

            $table->timestamps();
        });

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
