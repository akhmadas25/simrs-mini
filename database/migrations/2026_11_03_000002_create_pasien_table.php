<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm', 10)->unique();
            $table->char('nik', 16)->unique();
            $table->string('nama', 100);
            $table->char('jenis_kelamin', 1);
            $table->date('tanggal_lahir');
            $table->string('golongan_darah', 2);
            $table->string('no_telepon', 15);
            $table->text('alamat')->nullable();
            $table->foreignId('dokter_id')->nullable()->constrained('dokter')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
