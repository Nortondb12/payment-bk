<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('payments', 'pending_reason') || Schema::hasColumn('payments', 'status_note')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table): void {
            $table->renameColumn('pending_reason', 'status_note');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('payments', 'status_note') || Schema::hasColumn('payments', 'pending_reason')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table): void {
            $table->renameColumn('status_note', 'pending_reason');
        });
    }
};
