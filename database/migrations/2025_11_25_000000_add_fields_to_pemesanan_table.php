<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pemesanan', 'nama_pemesan')) {
                $table->string('nama_pemesan', 150)->nullable()->after('kode_pemesanan');
            }
            if (!Schema::hasColumn('pemesanan', 'nik')) {
                $table->string('nik', 20)->nullable()->after('nama_pemesan');
            }
            if (!Schema::hasColumn('pemesanan', 'nohp')) {
                $table->string('nohp', 15)->nullable()->after('nik');
            }
            if (!Schema::hasColumn('pemesanan', 'catatan')) {
                $table->text('catatan')->nullable()->after('pilihan_pembayaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            if (Schema::hasColumn('pemesanan', 'nama_pemesan')) {
                $table->dropColumn('nama_pemesan');
            }
            if (Schema::hasColumn('pemesanan', 'nik')) {
                $table->dropColumn('nik');
            }
            if (Schema::hasColumn('pemesanan', 'nohp')) {
                $table->dropColumn('nohp');
            }
            if (Schema::hasColumn('pemesanan', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
};
