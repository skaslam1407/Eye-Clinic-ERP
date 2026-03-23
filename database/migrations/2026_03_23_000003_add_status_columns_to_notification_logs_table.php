<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notification_logs', function (Blueprint $table) {
            $table->string('status')->nullable()->after('sent_at');
            $table->string('provider_id')->nullable()->after('status');
            $table->text('error')->nullable()->after('provider_id');
        });
    }

    public function down(): void
    {
        Schema::table('notification_logs', function (Blueprint $table) {
            $table->dropColumn(['status', 'provider_id', 'error']);
        });
    }
};
