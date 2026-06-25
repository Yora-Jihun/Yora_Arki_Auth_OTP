<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->unsignedTinyInteger('failed_attempts')->default(0)->after('type');
            $table->timestamp('locked_at')->nullable()->after('failed_attempts');
        });
    }

    public function down(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->dropColumn(['failed_attempts', 'locked_at']);
        });
    }
};
