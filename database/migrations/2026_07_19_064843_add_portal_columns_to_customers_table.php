<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table): void {
            $table->after('is_blocked', function (Blueprint $table): void {
                $table->string('portal_token', 64)->nullable()->unique();
                $table->timestamp('portal_invited_at')->nullable();
            });
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table): void {
            $table->dropColumn(['portal_token', 'portal_invited_at']);
        });
    }
};
