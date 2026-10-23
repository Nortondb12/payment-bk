<?php

declare(strict_types=1);

use App\Models\Activity;
use App\Models\ApiKey;
use App\Models\BalanceVerification;
use App\Models\BankGateway;
use App\Models\Brand;
use App\Models\BrandSetting;
use App\Models\BrandUser;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Faq;
use App\Models\Gateway;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Liquid;
use App\Models\MfsTransaction;
use App\Models\NotificationChannel;
use App\Models\Orderbox;
use App\Models\Payment;
use App\Models\PaymentLink;
use App\Models\Permission;
use App\Models\Refund;
use App\Models\Role;
use App\Models\Setting;
use App\Models\TextFile;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Old App\Models\* class names mapped to new simple morph keys.
     *
     * @var array<string, string>
     */
    private array $map = [
        Activity::class => 'activity',
        ApiKey::class => 'api-key',
        Brand::class => 'brand',
        BrandUser::class => 'brand-user',
        BrandSetting::class => 'brand-setting',
        ThemeSetting::class => 'theme-setting',
        Currency::class => 'currency',
        Customer::class => 'customer',
        BalanceVerification::class => 'balance-verification',
        Device::class => 'device',
        Faq::class => 'faq',
        BankGateway::class => 'bank-gateway',
        Gateway::class => 'gateway',
        Invoice::class => 'invoice',
        InvoiceItem::class => 'invoice-item',
        Liquid::class => 'liquid',
        MfsTransaction::class => 'mfs-transaction',
        NotificationChannel::class => 'notification-channel',
        Orderbox::class => 'orderbox',
        Payment::class => 'payment',
        Refund::class => 'refund',
        PaymentLink::class => 'payment-link',
        Permission::class => 'permission',
        Role::class => 'role',
        Setting::class => 'setting',
        TextFile::class => 'text-file',
        User::class => 'user',
    ];

    /**
     * Tables and their morph type columns to update.
     *
     * @var array<string, list<string>>
     */
    private array $tables = [
        'activities' => ['subject_type', 'causer_type'],
        'notifications' => ['notifiable_type'],
        'personal_access_tokens' => ['tokenable_type'],
    ];

    public function up(): void
    {
        foreach ($this->tables as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                DB::table($table)
                    ->where($column, 'App\Models\Domain')
                    ->delete();

                foreach ($this->map as $old => $new) {
                    DB::table($table)
                        ->where($column, $old)
                        ->update([$column => $new]);
                }
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                foreach ($this->map as $old => $new) {
                    DB::table($table)
                        ->where($column, $new)
                        ->update([$column => $old]);
                }
            }
        }
    }
};
