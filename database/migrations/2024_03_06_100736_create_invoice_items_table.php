<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('invoice_items')) {
            Schema::create('invoice_items', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->foreignId('invoice_id');
                $table->longText('description');
                $table->integer('quantity')->default(1);
                $table->decimal('amount', 28, 8)->default(0);
                $table->decimal('discount', 28, 8)->default(0);
                $table->decimal('vat', 5, 2)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table): void {
            $table->dropIfExists();
        });
    }
};
