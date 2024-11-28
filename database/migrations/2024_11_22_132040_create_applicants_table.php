<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // Relasi ke tabel users
                  ->constrained()
                  ->onDelete('cascade'); // Hapus data jika user terkait dihapus
            $table->string('name'); // Nama pelamar, diambil dari user
            $table->string('email'); // Email pelamar, diambil dari user
            $table->string('cv'); // Nama file CV yang diunggah (PDF)
            $table->string('company'); // diambil dari tabel database jobs sesuai dengan card yang ditekan
            $table->enum('status', ['pending', 'accepted', 'rejected']) // Status lamaran
                  ->default('pending'); // Default status
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
