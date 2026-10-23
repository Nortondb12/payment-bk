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
        if (! Schema::hasTable('payment_links')) {
            Schema::create('payment_links', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('track_id');
                $table->string('product_name');
                $table->text('product_description')->nullable();
                $table->unsignedBigInteger('quantity')->default(0);
                $table->longText('form_data')->nullable();
                $table->string('currency', 45);
                $table->decimal('amount', 28, 8)->default(0);
                $table->text('redirect_url')->nullable();
                $table->boolean('status')->default(1);
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();
                $table->unique(['brand_id', 'track_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_links');
    }
};
