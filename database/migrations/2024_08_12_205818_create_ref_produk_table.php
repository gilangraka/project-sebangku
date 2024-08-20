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
        Schema::create('ref_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->decimal('harga');
            $table->string('gambar_produk');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('ref_status')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_produk');
    }
};
