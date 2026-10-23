<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var array<string, string>
     */
    private const PAYABLE_COLUMNS = [
        'invoice_id' => 'invoice',
        'liquid_id' => 'liquid',
        'shopify_id' => 'shopify',
        'payment_link_id' => 'payment-link',
    ];

    private const INDEX = 'payments_brand_id_payable_index';

    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table): void {
            if (! Schema::hasColumn('payments', 'payable_type')) {
                $table->string('payable_type', 191)->nullable()->after('customer_id');
            }

            if (! Schema::hasColumn('payments', 'payable_id')) {
                $table->unsignedBigInteger('payable_id')->nullable()->after('payable_type');
            }
        });

        Schema::table('payments', function (Blueprint $table): void {
            if (! Schema::hasIndex('payments', self::INDEX)) {
                $table->index(['brand_id', 'payable_type', 'payable_id', 'deleted_at', 'created_at'], self::INDEX);
            }
        });

        foreach (self::PAYABLE_COLUMNS as $column => $alias) {
            DB::table('payments')
                ->whereNotNull($column)
                ->whereNull('payable_id')
                ->update([
                    'payable_type' => $alias,
                    'payable_id' => DB::raw($column),
                ]);
        }
    }

    public function down(): void
    {
        foreach (self::PAYABLE_COLUMNS as $column => $alias) {
            DB::table('payments')
                ->where('payable_type', $alias)
                ->whereNotNull('payable_id')
                ->update([$column => DB::raw('payable_id')]);
        }

        Schema::table('payments', function (Blueprint $table): void {
            if (Schema::hasIndex('payments', self::INDEX)) {
                $table->dropIndex(self::INDEX);
            }

            $table->dropColumn(['payable_type', 'payable_id']);
        });
    }
};
