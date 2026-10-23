<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! $this->shouldChangeTo('varchar')) {
            return;
        }

        Schema::table('personal_access_tokens', function (Blueprint $table): void {
            $table->string('device_id', 191)->nullable()->change();
        });
    }

    public function down(): void
    {
        if (! $this->shouldChangeTo('text')) {
            return;
        }

        Schema::table('personal_access_tokens', function (Blueprint $table): void {
            $table->text('device_id')->nullable()->change();
        });
    }

    private function shouldChangeTo(string $type): bool
    {
        if (! Schema::hasTable('personal_access_tokens') || ! Schema::hasColumn('personal_access_tokens', 'device_id')) {
            return false;
        }

        return Schema::getColumnType('personal_access_tokens', 'device_id') !== $type;
    }
};
