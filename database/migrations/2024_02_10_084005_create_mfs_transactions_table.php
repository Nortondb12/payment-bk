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
        if (! Schema::hasTable('mfs_transactions')) {
            Schema::create('mfs_transactions', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('device_id')->nullable();
                $table->string('payment_method');
                $table->enum('type', ['personal', 'merchant', 'agent'])->default('personal');
                $table->string('phone_number');
                $table->string('transaction_id');
                $table->decimal('amount', 28, 2)->default(0);
                $table->decimal('balance', 28, 2)->default(0);
                $table->string('ref')->nullable();
                $table->text('note')->nullable();
                $table->enum('status', ['approved', 'pending', 'used'])->default('approved');
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['transaction_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mfs_transactions', function (Blueprint $table): void {
            $table->dropIfExists();
        });
    }
};
