<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('payments', 'attachment')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table): void {
            $table->json('attachment')->nullable()->after('bank_data');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('payments', 'attachment')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table): void {
            $table->dropColumn('attachment');
        });
    }
};
