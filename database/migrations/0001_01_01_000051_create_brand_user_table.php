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
        if (! Schema::hasTable('brand_user')) {
            Schema::create('brand_user', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->foreignId('user_id');
                $table->timestamps();
                $table->unique(['brand_id', 'user_id']);
                $table->index(['brand_id']);
                $table->index(['user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_user');
    }
};
