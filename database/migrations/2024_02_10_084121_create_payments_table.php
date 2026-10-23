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
        if (! Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table): void {
                $table->id();

                // Foreign key relationship
                $table->foreignId('brand_id');
                $table->foreignId('gateway_id')->nullable();
                $table->foreignId('customer_id')->nullable();

                // Invoice
                $table->foreignId('invoice_id')->nullable();
                $table->foreignId('liquid_id')->nullable();
                $table->foreignId('payment_link_id')->nullable();

                // Identifier
                $table->string('payment_id');

                // Base currency
                $table->string('currency')->nullable();
                $table->decimal('amount', 28, 8)->default(0);
                $table->decimal('fixed_discount', 28, 8)->default(0);
                $table->decimal('percent_discount', 28, 8)->default(0);
                $table->decimal('total_discount', 28, 8)->default(0);
                $table->decimal('fixed_charge', 28, 8)->default(0.00000000);
                $table->decimal('percent_charge', 28, 8)->default(0.00000000);
                $table->decimal('total_charge', 28, 8)->default(0.00000000);
                $table->decimal('final_amount', 28, 8)->default(0.00000000);

                // Merchant
                $table->string('merchant_currency')->nullable();
                $table->decimal('merchant_amount', 28, 8)->default(0);
                $table->decimal('merchant_fixed_discount', 28, 8)->default(0);
                $table->decimal('merchant_percent_discount', 28, 8)->default(0);
                $table->decimal('merchant_total_discount', 28, 8)->default(0);
                $table->decimal('merchant_fixed_charge', 28, 8)->default(0.00000000);
                $table->decimal('merchant_percent_charge', 28, 8)->default(0.00000000);
                $table->decimal('merchant_total_charge', 28, 8)->default(0.00000000);
                $table->decimal('merchant_final_amount', 28, 8)->default(0.00000000);
                $table->decimal('merchant_rate', 28, 8)->default(1);

                // Gateway
                $table->string('gateway_currency')->nullable();
                $table->decimal('gateway_amount', 28, 8)->default(0);
                $table->decimal('gateway_fixed_discount', 28, 8)->default(0);
                $table->decimal('gateway_percent_discount', 28, 8)->default(0);
                $table->decimal('gateway_total_discount', 28, 8)->default(0);
                $table->decimal('gateway_fixed_charge', 28, 8)->default(0.00000000);
                $table->decimal('gateway_percent_charge', 28, 8)->default(0.00000000);
                $table->decimal('gateway_total_charge', 28, 8)->default(0.00000000);
                $table->decimal('gateway_final_amount', 28, 8)->default(0.00000000);
                $table->decimal('gateway_rate', 28, 8)->default(1);

                $table->string('gateway_phone_number', 191)->nullable();
                $table->string('gateway_transaction_id', 191)->nullable();
                $table->string('gateway_reference_id', 191)->nullable();

                // Information
                $table->json('bank_data')->nullable();
                $table->json('payment_link_data')->nullable();
                $table->json('metadata')->nullable();
                $table->json('product')->nullable();
                $table->json('extra')->nullable();
                $table->json('checkout_config')->nullable();

                $table->text('success_url');
                $table->text('cancel_url');
                $table->text('ipn_url')->nullable();

                $table->tinyInteger('is_automatic')->default(1);
                $table->tinyInteger('is_uddoktapay')->default(0);
                $table->boolean('feature_used')->default(0);
                $table->string('status', 30)->default('initiated');

                $table->timestamps();
                $table->softDeletes();

                $table->unique(['brand_id', 'payment_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table): void {
            $table->dropIfExists();
        });
    }
};
