<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('shopifies')) {
            Schema::create('shopifies', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('track_id');
                $table->string('label');
                $table->string('shop_domain');
                $table->string('client_id');
                $table->string('client_secret');
                $table->timestamps();
                $table->unique(['brand_id', 'track_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('shopifies');
    }
};
