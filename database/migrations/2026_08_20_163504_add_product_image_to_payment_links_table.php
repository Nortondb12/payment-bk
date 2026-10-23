<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('payment_links', 'product_image')) {
            return;
        }

        Schema::table('payment_links', function (Blueprint $table): void {
            $table->string('product_image')->nullable()->after('product_description');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('payment_links', 'product_image')) {
            return;
        }

        Schema::table('payment_links', function (Blueprint $table): void {
            $table->dropColumn('product_image');
        });
    }
};
