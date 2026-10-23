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
        if (! Schema::hasTable('text_files')) {
            Schema::create('text_files', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->string('extension', 10);
                $table->string('mime_type')->nullable();
                $table->longText('content');
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['is_active']);
                $table->unique(['name']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_files');
    }
};
