<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var array<string, array<string, list<string>>>
     */
    private const INDEXES = [
        'activities' => [
            'activities_brand_id_id_index' => ['brand_id', 'id'],
            'activities_event_id_index' => ['event', 'id'],
            'activities_created_at_id_index' => ['created_at', 'id'],
        ],
        'api_keys' => [
            'api_keys_brand_id_id_index' => ['brand_id', 'id'],
        ],
        'brands' => [
            'brands_is_default_index' => ['is_default'],
            'brands_name_index' => ['name'],
        ],
        'customers' => [
            'customers_brand_id_id_index' => ['brand_id', 'id'],
            'customers_brand_id_first_name_index' => ['brand_id', 'first_name'],
            'customers_brand_id_last_name_index' => ['brand_id', 'last_name'],
            'customers_brand_id_email_index' => ['brand_id', 'email'],
            'customers_brand_id_phone_index' => ['brand_id', 'phone'],
            'customers_brand_id_created_from_id_index' => ['brand_id', 'created_from', 'id'],
            'customers_brand_id_country_id_index' => ['brand_id', 'country', 'id'],
            'customers_brand_id_city_index' => ['brand_id', 'city'],
            'customers_brand_id_state_index' => ['brand_id', 'state'],
            'customers_brand_id_created_at_id_index' => ['brand_id', 'created_at', 'id'],
        ],
        'invoices' => [
            'invoices_brand_id_deleted_at_id_index' => ['brand_id', 'deleted_at', 'id'],
            'invoices_brand_id_deleted_at_status_id_index' => ['brand_id', 'deleted_at', 'status', 'id'],
            'invoices_brand_id_deleted_at_currency_id_index' => ['brand_id', 'deleted_at', 'currency', 'id'],
            'invoices_brand_id_customer_id_id_index' => ['brand_id', 'customer_id', 'id'],
            'invoices_brand_id_deleted_at_created_at_id_index' => ['brand_id', 'deleted_at', 'created_at', 'id'],
        ],
        'orderboxes' => [
            'orderboxes_brand_id_id_index' => ['brand_id', 'id'],
        ],
        'shopifies' => [
            'shopifies_brand_id_id_index' => ['brand_id', 'id'],
        ],
        'payment_links' => [
            'payment_links_brand_id_id_index' => ['brand_id', 'id'],
            'payment_links_brand_id_product_name_index' => ['brand_id', 'product_name'],
            'payment_links_brand_id_currency_index' => ['brand_id', 'currency'],
            'payment_links_brand_id_created_at_id_index' => ['brand_id', 'created_at', 'id'],

        ],
        'personal_access_tokens' => [
            'personal_access_tokens_device_id_index' => ['device_id'],
        ],
        'passkeys' => [
            'passkeys_user_id_index' => ['user_id'],
        ],
        'notifications' => [
            'notifications_notifiable_created_at_index' => ['notifiable_type', 'notifiable_id', 'created_at'],
            'notifications_notifiable_read_at_index' => ['notifiable_type', 'notifiable_id', 'read_at'],
        ],
        'permission_role' => [
            'permission_role_role_id_permission_id_index' => ['role_id', 'permission_id'],
        ],
        'permission_user' => [
            'permission_user_user_id_permission_id_index' => ['user_id', 'permission_id'],
        ],
        'role_user' => [
            'role_user_user_id_role_id_index' => ['user_id', 'role_id'],
        ],
        'users' => [
            'users_is_super_admin_id_index' => ['is_super_admin', 'id'],
        ],
        'refunds' => [
            'refunds_brand_id_payment_id_id_index' => ['brand_id', 'payment_id', 'id'],
            'refunds_brand_id_created_at_amount_index' => ['brand_id', 'created_at', 'amount'],
        ],
        'payments' => [
            'payments_gateway_transaction_id_index' => ['gateway_transaction_id'],
            'payments_unique_amount_pool_index' => ['gateway_id', 'status', 'deleted_at', 'created_at'],
            'payments_brand_id_deleted_at_id_index' => ['brand_id', 'deleted_at', 'id'],
            'payments_brand_id_deleted_at_status_id_index' => ['brand_id', 'deleted_at', 'status', 'id'],
            'payments_brand_id_deleted_at_created_at_id_index' => ['brand_id', 'deleted_at', 'created_at', 'id'],
            'payments_brand_id_gateway_id_id_index' => ['brand_id', 'gateway_id', 'id'],
            'payments_brand_id_customer_id_id_index' => ['brand_id', 'customer_id', 'id'],
            'payments_brand_id_invoice_id_index' => ['brand_id', 'invoice_id'],
            'payments_brand_id_gateway_phone_number_index' => ['brand_id', 'gateway_phone_number'],
            'payments_report_revenue_index' => ['brand_id', 'deleted_at', 'status', 'created_at', 'final_amount'],
            'payments_report_gateway_index' => ['brand_id', 'deleted_at', 'created_at', 'gateway_id', 'status', 'final_amount'],
            'payments_report_customer_index' => ['brand_id', 'deleted_at', 'status', 'created_at', 'customer_id', 'final_amount'],
        ],
        'notification_channels' => [
            'notification_channels_brand_id_is_active_index' => ['brand_id', 'is_active'],
            'notification_channels_brand_id_id_index' => ['brand_id', 'id'],
        ],
        'mfs_transactions' => [
            'mfs_transactions_deposit_match_index' => ['payment_method', 'type', 'status', 'deleted_at', 'created_at'],
            'mfs_transactions_device_pending_index' => ['device_id', 'payment_method', 'type', 'status', 'deleted_at', 'created_at'],
            'mfs_transactions_deleted_at_id_index' => ['deleted_at', 'id'],
            'mfs_transactions_deleted_at_status_id_index' => ['deleted_at', 'status', 'id'],
            'mfs_transactions_deleted_at_payment_method_id_index' => ['deleted_at', 'payment_method', 'id'],
            'mfs_transactions_deleted_at_type_id_index' => ['deleted_at', 'type', 'id'],
            'mfs_transactions_deleted_at_device_id_id_index' => ['deleted_at', 'device_id', 'id'],
            'mfs_transactions_deleted_at_created_at_id_index' => ['deleted_at', 'created_at', 'id'],
            'mfs_transactions_phone_number_index' => ['phone_number'],
        ],
        'liquids' => [
            'liquids_brand_id_id_index' => ['brand_id', 'id'],
        ],
        'invoice_items' => [
            'invoice_items_brand_id_invoice_id_index' => ['brand_id', 'invoice_id'],
        ],
        'gateways' => [
            'gateways_brand_id_status_index' => ['brand_id', 'status'],
            'gateways_group_index' => ['group'],
            'gateways_brand_id_is_automatic_id_index' => ['brand_id', 'is_automatic', 'id'],
            'gateways_brand_id_is_automatic_currency_index' => ['brand_id', 'is_automatic', 'currency'],
            'gateways_brand_id_is_automatic_order_column_index' => ['brand_id', 'is_automatic', 'order_column'],
            'gateways_brand_id_is_automatic_display_name_index' => ['brand_id', 'is_automatic', 'display_name'],
            'gateways_brand_id_type_mode_id_index' => ['brand_id', 'type', 'mode', 'id'],
            'gateways_brand_id_type_mode_display_name_index' => ['brand_id', 'type', 'mode', 'display_name'],
            'gateways_brand_id_type_mode_currency_index' => ['brand_id', 'type', 'mode', 'currency'],
            'gateways_brand_id_type_mode_order_column_index' => ['brand_id', 'type', 'mode', 'order_column'],
        ],
        'faqs' => [
            'faqs_brand_id_id_index' => ['brand_id', 'id'],
            'faqs_brand_id_status_order_column_index' => ['brand_id', 'status', 'order_column'],
            'faqs_brand_id_order_column_index' => ['brand_id', 'order_column'],
        ],
        'devices' => [
            'devices_device_name_index' => ['device_name'],
        ],
        'currencies' => [
            'currencies_is_enabled_code_index' => ['is_enabled', 'code'],
        ],
    ];

    /**
     * @var array<string, array<string, list<string>>>
     */
    private const UNIQUES = [
        'api_keys' => [
            'api_keys_token_unique' => ['token'],
        ],
        'brand_user' => [
            'brand_user_user_id_brand_id_unique' => ['user_id', 'brand_id'],
        ],
        'invoices' => [
            'invoices_track_id_unique' => ['track_id'],
        ],
        'liquids' => [
            'liquids_track_id_unique' => ['track_id'],
        ],
        'orderboxes' => [
            'orderboxes_track_id_unique' => ['track_id'],
        ],
        'payment_links' => [
            'payment_links_track_id_unique' => ['track_id'],
        ],
        'shopifies' => [
            'shopifies_track_id_unique' => ['track_id'],
        ],
    ];

    /**
     * @var array<string, array<string, list<string>>>
     */
    private const SUPERSEDED = [
        'activities' => [
            'causer' => ['causer_type', 'causer_id'],
        ],
        'balance_verifications' => [
            'device_balance_lookup' => ['device_id', 'method', 'type'],
        ],
        'brand_user' => [
            'brand_user_brand_id_index' => ['brand_id'],
            'brand_user_user_id_index' => ['user_id'],
        ],
        'refunds' => [
            'refunds_brand_id_index' => ['brand_id'],
            'refunds_payment_id_index' => ['payment_id'],
        ],
        'notifications' => [
            'notifications_notifiable_type_notifiable_id_index' => ['notifiable_type', 'notifiable_id'],
        ],
        'permission_role' => [
            'permission_role_permission_id_role_id_index' => ['permission_id', 'role_id'],
        ],
        'permission_user' => [
            'permission_user_permission_id_user_id_index' => ['permission_id', 'user_id'],
        ],
        'role_user' => [
            'role_user_role_id_user_id_index' => ['role_id', 'user_id'],
        ],
    ];

    /**
     * @var array<string, array<string, list<string>>>
     */
    private const SUPERSEDED_UNIQUES = [
        'api_keys' => [
            'api_keys_brand_id_token_unique' => ['brand_id', 'token'],
        ],
        'brand_user' => [
            'brand_user_brand_id_user_id_unique' => ['brand_id', 'user_id'],
        ],
        'invoices' => [
            'invoices_brand_id_track_id_unique' => ['brand_id', 'track_id'],
        ],
        'liquids' => [
            'liquids_brand_id_track_id_unique' => ['brand_id', 'track_id'],
        ],
        'orderboxes' => [
            'orderboxes_brand_id_track_id_unique' => ['brand_id', 'track_id'],
        ],
        'payment_links' => [
            'payment_links_brand_id_track_id_unique' => ['brand_id', 'track_id'],
        ],
        'shopifies' => [
            'shopifies_brand_id_track_id_unique' => ['brand_id', 'track_id'],
        ],
    ];

    public function up(): void
    {
        $this->add(self::INDEXES);
        $this->add(self::UNIQUES, unique: true);
        $this->drop(self::SUPERSEDED);
        $this->drop(self::SUPERSEDED_UNIQUES);
    }

    public function down(): void
    {
        $this->add(self::SUPERSEDED);
        $this->add(self::SUPERSEDED_UNIQUES, unique: true);
        $this->drop(self::INDEXES);
        $this->drop(self::UNIQUES);
    }

    /**
     * @param  array<string, array<string, list<string>>>  $tables
     */
    private function add(array $tables, bool $unique = false): void
    {
        foreach ($tables as $table => $indexes) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table, $indexes, $unique): void {
                foreach ($indexes as $name => $columns) {
                    if (Schema::hasIndex($table, $name)) {
                        continue;
                    }

                    $unique
                        ? $blueprint->unique($columns, $name)
                        : $blueprint->index($columns, $name);
                }
            });
        }
    }

    /**
     * @param  array<string, array<string, list<string>>>  $tables
     */
    private function drop(array $tables): void
    {
        foreach ($tables as $table => $indexes) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table, $indexes): void {
                foreach (array_keys($indexes) as $name) {
                    if (! Schema::hasIndex($table, $name)) {
                        continue;
                    }

                    $blueprint->dropIndex($name);
                }
            });
        }
    }
};
