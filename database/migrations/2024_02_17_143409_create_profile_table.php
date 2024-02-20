<?php

use Carbon\Carbon;
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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_murobbi')->nullable();
            $table->foreign('id_murobbi')->references('id')->on('users')->onDelete('cascade');

            $table->string('photo_profile')->nullable();
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita'])->default('pria');
            $table->date('tanggal_lahir')->nullable()->default(Carbon::now());
            $table->string('nomor_telepon')->nullable();
            $table->string('amanah')->nullable();
            $table->string('agama')->default('islam');
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->text('alamat')->nullable();
            $table->text('bio')->nullable();
            $table->enum('status_pernikahan', ['menikah', 'cerai', 'lajang'])->default('lajang');
            $table->string('pendidikan_terakhir')->default('sma');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
