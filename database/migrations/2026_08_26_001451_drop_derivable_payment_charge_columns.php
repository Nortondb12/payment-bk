<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const DERIVABLE_COLUMNS = [
        'merchant_fixed_discount',
        'merchant_percent_discount',
        'merchant_total_discount',
        'merchant_fixed_charge',
        'merchant_percent_charge',
        'gateway_fixed_discount',
        'gateway_percent_discount',
        'gateway_fixed_charge',
        'gateway_percent_charge',
    ];

    private const PRECISION = 28;

    private const SCALE = 8;

    public function up(): void
    {
        $columns = $this->columnsThatExist();

        if ($columns === []) {
            return;
        }

        Schema::table('payments', function (Blueprint $blueprint) use ($columns): void {
            $blueprint->dropColumn($columns);
        });
    }

    public function down(): void
    {
        $columns = array_diff(self::DERIVABLE_COLUMNS, $this->columnsThatExist());

        if ($columns === []) {
            return;
        }

        Schema::table('payments', function (Blueprint $blueprint) use ($columns): void {
            foreach ($columns as $column) {
                $blueprint->decimal($column, self::PRECISION, self::SCALE)->default(0);
            }
        });
    }

    /**
     * @return list<string>
     */
    private function columnsThatExist(): array
    {
        return array_values(array_filter(
            self::DERIVABLE_COLUMNS,
            fn (string $column): bool => Schema::hasColumn('payments', $column),
        ));
    }
};
