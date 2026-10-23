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
        if (! Schema::hasTable('invoices')) {
            Schema::create('invoices', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->foreignId('customer_id')->nullable();
                $table->string('track_id');
                $table->string('currency');
                $table->string('shipping_amount')->default(0);
                $table->longText('notes')->nullable();
                $table->longText('private_notes')->nullable();
                $table->text('redirect_url')->nullable();
                $table->string('status', 30)->default('unpaid');
                $table->dateTime('due_date')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['brand_id', 'track_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table): void {
            $table->dropIfExists();
        });
    }
};
