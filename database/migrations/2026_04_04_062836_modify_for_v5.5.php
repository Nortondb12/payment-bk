<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->modifyUsersTable();
        $this->modifyCustomersTable();
        $this->modifyTextFilesTable();
        $this->modifyPaymentLinksTable();
        $this->modifyApiKeysTable();
        $this->modifyPaymentsTable();
        $this->modifyInvoicesTable();
        $this->modifySettingsTable();
        $this->cleanupData();
    }

    public function down(): void
    {
        //
    }

    private function modifyUsersTable(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            if (! Schema::hasColumn('users', 'can_connect_new_device')) {
                $table->tinyInteger('can_connect_new_device')->default(1)->after('has_email_authentication');
            }

            if (! Schema::hasColumn('users', 'device_secret')) {
                $table->string('device_secret', 64)->nullable()->unique()->after('can_connect_new_device');
            }

            if (! Schema::hasColumn('users', 'notification_key')) {
                $table->string('notification_key')->nullable()->after('device_secret');
            }
        });
    }

    /**
     * Rename and add must be separate calls — renameColumn must
     * complete before after('first_name') can reference the column.
     */
    private function modifyCustomersTable(): void
    {
        if (Schema::hasColumn('customers', 'name')) {
            Schema::table('customers', function (Blueprint $table): void {
                $table->renameColumn('name', 'first_name');
            });
        }

        if (! Schema::hasColumn('customers', 'last_name')) {
            Schema::table('customers', function (Blueprint $table): void {
                $table->string('last_name')->nullable()->after('first_name');
            });
        }
    }

    private function modifyTextFilesTable(): void
    {
        if (! Schema::hasColumn('text_files', 'brand_id')) {
            return;
        }

        Schema::table('text_files', function (Blueprint $table): void {
            if (Schema::hasIndex('text_files', ['brand_id', 'name'])) {
                $table->dropUnique(['brand_id', 'name']);
            }

            if (Schema::hasIndex('text_files', ['brand_id', 'is_active'])) {
                $table->dropIndex(['brand_id', 'is_active']);
            }

            $table->dropColumn('brand_id');
        });
    }

    private function modifyPaymentLinksTable(): void
    {
        Schema::table('payment_links', function (Blueprint $table): void {
            if (Schema::getColumnType('payment_links', 'quantity') !== 'bigint') {
                $table->unsignedBigInteger('quantity')->default(0)->change();
            }

            if (! Schema::hasColumn('payment_links', 'redirect_url')) {
                $table->text('redirect_url')->nullable()->after('amount');
            }
        });
    }

    private function modifyApiKeysTable(): void
    {
        if (Schema::getColumnType('api_keys', 'expires_at') === 'datetime') {
            return;
        }

        Schema::table('api_keys', function (Blueprint $table): void {
            $table->dateTime('expires_at')->nullable()->change();
        });
    }

    private function modifyPaymentsTable(): void
    {
        if (Schema::hasColumn('payments', 'deleted_at')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table): void {
            $table->softDeletes();
        });
    }

    private function modifyInvoicesTable(): void
    {
        if (Schema::hasColumn('invoices', 'redirect_url')) {
            return;
        }

        Schema::table('invoices', function (Blueprint $table): void {
            $table->text('redirect_url')->nullable()->after('private_notes');
        });
    }

    private function modifySettingsTable(): void
    {
        if (Schema::getColumnType('settings', 'value') === 'text') {
            return;
        }

        Schema::table('settings', function (Blueprint $table): void {
            $table->longText('value')->nullable()->change();
        });
    }

    private function cleanupData(): void
    {
        DB::transaction(function (): void {
            DB::table('theme_settings')
                ->where('value', '')
                ->orWhereNull('value')
                ->delete();
        });

        Schema::dropIfExists('update_logs');
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('addons');
    }
};
