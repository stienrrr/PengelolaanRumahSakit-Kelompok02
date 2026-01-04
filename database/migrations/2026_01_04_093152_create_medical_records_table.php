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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            // Menghubungkan ke tabel user (dengan role dokter)
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            // Menghubungkan ke transaksi pendaftaran/kunjungan
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');

            $table->date('date');
            $table->text('complaint'); // Keluhan
            $table->text('diagnosis'); // Diagnosa
            $table->text('treatment'); // Tindakan/Obat yang disarankan secara umum

            // Data Tambahan (Vital Signs)
            $table->string('blood_pressure')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
