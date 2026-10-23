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
        if (! Schema::hasTable('balance_verifications')) {
            Schema::create('balance_verifications', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('device_id');
                $table->string('method')->index();
                $table->enum('type', ['personal', 'merchant', 'agent'])->default('personal')->index();
                $table->decimal('balance', 28, 2)->default(0.00);
                $table->boolean('balance_verification_enabled')->default(true);
                $table->boolean('smart_verification_enabled')->default(true);
                $table->timestamps();
                $table->unique(['device_id', 'method', 'type'], 'device_method_type_unique');
                $table->index(['device_id', 'method', 'type'], 'device_balance_lookup');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_verifications');
    }
};
