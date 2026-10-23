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
        if (! Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
                $table->unique(['name', 'guard_name']);
            });
        }

        if (! Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
                $table->unique(['name', 'guard_name']);
            });
        }

        if (! Schema::hasTable('permission_user')) {
            Schema::create('permission_user', function (Blueprint $table): void {
                $table->foreignId('permission_id');
                $table->foreignId('user_id');
                $table->primary(['permission_id', 'user_id'], 'permission_user_permission_id_user_id_primary');
                $table->index(['permission_id', 'user_id'], 'permission_user_permission_id_user_id_index');
            });
        }

        if (! Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table): void {
                $table->foreignId('role_id');
                $table->foreignId('user_id');
                $table->primary(['role_id', 'user_id'], 'role_user_role_id_user_id_primary');
                $table->index(['role_id', 'user_id'], 'role_user_role_id_user_id_index');
            });
        }

        if (! Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table): void {
                $table->foreignId('permission_id');
                $table->foreignId('role_id');
                $table->primary(['permission_id', 'role_id'], 'permission_role_permission_id_role_id_primary');
                $table->index(['permission_id', 'role_id'], 'permission_role_permission_id_role_id_index');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('permission_role');
        Schema::drop('role_user');
        Schema::drop('permission_user');
        Schema::drop('roles');
        Schema::drop('permissions');
    }
};
