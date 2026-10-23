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
        if (! Schema::hasTable('gateways')) {
            Schema::create('gateways', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('name');
                $table->string('display_name');
                $table->string('image')->nullable();
                $table->string('currency');
                $table->string('symbol');
                $table->string('alias');
                $table->string('group');
                $table->string('code');
                $table->decimal('min_amount', 28, 8)->unsigned()->default(1);
                $table->decimal('max_amount', 28, 8)->unsigned()->default(0);
                $table->decimal('percent_charge', 5, 2)->unsigned()->default(0);
                $table->decimal('fixed_charge', 28, 8)->unsigned()->default(0);
                $table->decimal('percent_discount', 5, 2)->default(0);
                $table->decimal('fixed_discount', 28, 8)->default(0);
                $table->boolean('has_qr_code')->default(false);
                $table->text('qr_code')->nullable();
                $table->text('parameters')->nullable();
                $table->text('gateway_parameters')->nullable();
                $table->text('extra')->nullable();
                $table->text('description')->nullable();
                $table->integer('order_column')->default(0);
                $table->tinyInteger('is_automatic')->default(1);
                $table->enum('type', ['mfs', 'global', 'bank'])->default('bank');
                $table->enum('mode', ['live', 'manual', 'personal', 'merchant', 'agent'])->default('live');
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->unique(['brand_id', 'code']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gateways', function (Blueprint $table): void {
            $table->dropIfExists();
        });
    }
};
