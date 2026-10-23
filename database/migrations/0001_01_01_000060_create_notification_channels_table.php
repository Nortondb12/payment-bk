<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('notification_channels')) {
            Schema::create('notification_channels', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('brand_id');
                $table->string('name');
                $table->string('provider');
                $table->json('config')->nullable();
                $table->json('events')->nullable();
                $table->boolean('is_active')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_channels');
    }
};
