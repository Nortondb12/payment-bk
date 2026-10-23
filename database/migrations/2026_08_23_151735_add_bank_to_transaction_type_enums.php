<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var list<string>
     */
    private const TABLES = ['mfs_transactions', 'balance_verifications'];

    /**
     * @var list<string>
     */
    private const TYPES = ['personal', 'merchant', 'agent', 'bank'];

    /**
     * @var list<string>
     */
    private const PREVIOUS_TYPES = ['personal', 'merchant', 'agent'];

    public function up(): void
    {
        $this->setTypes(self::TYPES);
    }

    public function down(): void
    {
        $this->setTypes(self::PREVIOUS_TYPES);
    }

    /**
     * @param  list<string>  $types
     */
    private function setTypes(array $types): void
    {
        foreach (self::TABLES as $table) {
            if (! Schema::hasColumn($table, 'type')) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($types): void {
                $blueprint->enum('type', $types)->default('personal')->change();
            });
        }
    }
};
