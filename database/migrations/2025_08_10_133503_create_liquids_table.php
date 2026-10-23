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
        if (! Schema::hasTable('liquids')) {
            Schema::create('liquids', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('track_id');
                $table->string('label');
                $table->string('api_key');
                $table->string('reseller_id');
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
        Schema::dropIfExists('liquids');
    }
};
