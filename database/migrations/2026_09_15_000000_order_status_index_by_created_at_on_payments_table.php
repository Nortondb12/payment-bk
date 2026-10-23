<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OLD_INDEX = 'payments_brand_id_deleted_at_status_id_index';

    private const NEW_INDEX = 'payments_brand_id_deleted_at_status_created_at_index';

    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table): void {
            if (! Schema::hasIndex('payments', self::NEW_INDEX)) {
                $table->index(['brand_id', 'deleted_at', 'status', 'created_at', 'id'], self::NEW_INDEX);
            }

            if (Schema::hasIndex('payments', self::OLD_INDEX)) {
                $table->dropIndex(self::OLD_INDEX);
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table): void {
            if (! Schema::hasIndex('payments', self::OLD_INDEX)) {
                $table->index(['brand_id', 'deleted_at', 'status', 'id'], self::OLD_INDEX);
            }

            if (Schema::hasIndex('payments', self::NEW_INDEX)) {
                $table->dropIndex(self::NEW_INDEX);
            }
        });
    }
};
