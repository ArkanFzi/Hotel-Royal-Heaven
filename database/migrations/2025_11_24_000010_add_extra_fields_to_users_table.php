<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'nohp')) {
                $table->string('nohp')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('member')->after('nohp');
            }
            if (!Schema::hasColumn('users', 'api_token')) {
                $table->string('api_token', 80)->nullable()->unique()->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'api_token')) {
                $table->dropColumn('api_token');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'nohp')) {
                $table->dropColumn('nohp');
            }
            if (Schema::hasColumn('users', 'nik')) {
                $table->dropColumn('nik');
            }
        });
    }
};
