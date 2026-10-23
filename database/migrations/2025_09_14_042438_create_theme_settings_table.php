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
        if (! Schema::hasTable('theme_settings')) {
            Schema::create('theme_settings', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('theme');
                $table->string('name');
                $table->longText('value')->nullable();
                $table->timestamps();
                $table->unique(['brand_id', 'theme', 'name']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
