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
        if (! Schema::hasTable('refunds')) {
            Schema::create('refunds', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id')->index();
                $table->foreignId('payment_id')->nullable()->index();
                $table->string('currency', 3)->nullable();
                $table->decimal('amount', 28, 8)->default(0);
                $table->string('gateway_currency', 3)->nullable();
                $table->decimal('gateway_amount', 28, 8)->default(0);
                $table->text('reason')->nullable();
                $table->string('gateway_reference_id')->nullable();
                $table->enum('type', ['manual', 'gateway'])->default('manual');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
