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
        if (! Schema::hasTable('api_keys')) {
            Schema::create('api_keys', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('name');
                $table->string('token');
                $table->json('abilities')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamp('last_used_at')->nullable();
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();
                $table->unique(['brand_id', 'token']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};
