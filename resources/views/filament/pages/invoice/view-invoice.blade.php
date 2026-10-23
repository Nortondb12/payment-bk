<div>
    <x-filament-panels::page>
        <x-filament::section>
            <!-- Invoice -->
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:gap-8 md:gap-16 lg:gap-48 xl:gap-60">
                <div>
                    <img src="{{ app_logo() }}" alt="{{ app_name() }}" style="width: 20rem" />
                    <h2 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-neutral-200">
                        {{ __("Invoice #:id", ["id" => $this->getRecord()->id]) }}
                    </h2>
                </div>
                <div>
                    <div class="mt-3 flex">
                        <x-filament::badge
                            color="{{ \App\Enums\Invoice\InvoiceStatus::color($this->getRecord()->status) }}"
                        >
                            <span class="text-3xl">
                                {{ \Illuminate\Support\Str::upper(\App\Enums\Invoice\InvoiceStatus::name($this->getRecord()->status)) }}
                            </span>
                        </x-filament::badge>
                    </div>
                    @if ($this->getRecord()->isUnpaid() || $this->getRecord()->isPartial())
                        <a
                            href="{{ brand_route("invoice.checkout", ["track_id" => $this->getRecord()->track_id], absolute: true) }}"
                            class="fi-btn fi-color fi-color-primary fi-size-md fi-ac-btn-action mt-4 hidden rounded-lg px-4 py-2 text-sm leading-5 font-medium print:!inline-flex print:bg-[#2563eb] print:text-white print:no-underline print:shadow-none print:ring-0"
                            target="_blank"
                            rel="noopener"
                        >
                            Pay Now
                        </a>
                    @endif
                </div>
            </div>

            <!-- Grid -->
            <div class="mt-8 grid gap-3 sm:grid-cols-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">{{ "Invoice To:" }}</h3>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $this->getRecord()->customer?->name }}
                    </h3>
                    <address class="mt-2 text-gray-500 not-italic dark:text-neutral-500">
                        @if ($this->getRecord()->customer?->company)
                            {{ $this->getRecord()->customer->company }}
                            <br />
                        @endif

                        @php
                            $addressLine = collect([
                                $this->getRecord()->customer?->address,
                                $this->getRecord()->customer?->city,
                                $this->getRecord()->customer?->state,
                                $this->getRecord()->customer?->postcode,
                            ])
                                ->filter()
                                ->implode(", ");
                        @endphp

                        @if ($addressLine)
                            {{ $addressLine }}
                            <br />
                        @endif

                        @if ($this->getRecord()->customer?->country)
                            {{ $this->getRecord()->customer->country }}
                        @endif
                    </address>
                </div>

                <!-- Col -->
                <div class="sm:text-end">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">{{ "Pay To:" }}</h3>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">{{ app_name() }}</h3>
                    <address class="mt-2 text-gray-500 not-italic dark:text-neutral-500">
                        {{ $brandSettings->invoice_company_address }}

                        @if ($brandSettings->invoice_company_address)
                            <br />
                        @endif

                        {{ collect([$brandSettings->invoice_company_city, $brandSettings->invoice_company_postcode])->filter()->implode(", ") }}

                        @if ($brandSettings->invoice_company_city || $brandSettings->invoice_company_postcode)
                            <br />
                        @endif

                        {{ $brandSettings->invoice_company_country }}
                    </address>
                </div>
                <!-- Col -->
            </div>
            <!-- End Grid -->

            <!-- Invoice Date -->
            <div class="mt-3 flex gap-1">
                <div class="font-semibold text-gray-800 dark:text-neutral-200">{{ "Invoice Date:" }}</div>
                <div class="text-gray-500 dark:text-neutral-500">
                    {{ $this->getRecord()->created_at->appTimezone()->format("l, F jS, Y") }}
                </div>
            </div>
            <div class="mt-3 flex gap-1">
                @if (($this->getRecord()->isUnpaid() || $this->getRecord()->isPartial()) && $this->getRecord()->due_date)
                    <div class="font-semibold text-gray-800 dark:text-neutral-200">{{ "Due Date:" }}</div>
                    <div class="text-gray-500 dark:text-neutral-500">
                        {{ $this->getRecord()->due_date?->appTimezone()->format("l, F jS, Y") }}
                    </div>
                @endif
            </div>
            <!-- End Invoice Date -->

            <!-- Table -->
            <div class="mt-6">
                <div class="space-y-4 rounded-lg border border-gray-200 p-4 dark:border-neutral-700">
                    <div class="hidden sm:grid sm:grid-cols-5">
                        <div class="text-xs font-medium text-gray-500 uppercase sm:col-span-2 dark:text-neutral-500">
                            {{ "Item" }}
                        </div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            {{ "Quantity" }}
                        </div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            {{ "Discount" }}
                        </div>
                        <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            {{ "Amount" }}
                        </div>
                    </div>

                    <div class="hidden border-b border-gray-200 sm:block dark:border-neutral-700"></div>

                    @foreach ($this->getRecord()->items as $item)
                        <div class="grid grid-cols-3 gap-2 sm:grid-cols-5">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">
                                    {{ "Item" }}
                                </h5>
                                <p class="font-medium break-words text-gray-800 dark:text-neutral-200">
                                    {{ $item->description }}
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">
                                    {{ "Quantity" }}
                                </h5>
                                <p class="text-gray-800 dark:text-neutral-200">{{ $item->quantity }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">
                                    {{ "Discount" }}
                                </h5>
                                <p class="text-gray-800 dark:text-neutral-200">
                                    {{ $this->getRecord()->currency }} {{ get_amount($item->discount) }}
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500">
                                    {{ "Amount" }}
                                </h5>
                                <p class="text-gray-800 sm:text-end dark:text-neutral-200">
                                    {{ $this->getRecord()->currency }} {{ get_amount($item->amount) }}
                                </p>
                            </div>
                        </div>
                        @if (! $loop->last)
                            <div class="border-b border-gray-200 dark:border-neutral-700"></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- End Table -->

            <!-- Flex -->
            <div class="mt-8 flex sm:justify-end">
                <div class="w-full max-w-2xl space-y-2 sm:text-end">
                    <!-- Grid -->
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-1 sm:gap-2">
                        <dl class="grid gap-x-3 sm:grid-cols-5">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">
                                {{ "Sub Total:" }}
                            </dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $this->getRecord()->currency }} {{ get_amount($this->getRecord()->sub_total) }}
                            </dd>
                        </dl>

                        <dl class="grid gap-x-3 sm:grid-cols-5">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">
                                {{ "Discount:" }}
                            </dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $this->getRecord()->currency }} {{ get_amount($this->getRecord()->discount) }}
                            </dd>
                        </dl>

                        <dl class="grid gap-x-3 sm:grid-cols-5">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">{{ "VAT:" }}</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $this->getRecord()->currency }} {{ get_amount($this->getRecord()->vat) }}
                            </dd>
                        </dl>

                        @if ($this->getRecord()->shipping_amount > 0)
                            <dl class="grid gap-x-3 sm:grid-cols-5">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">
                                    {{ "Shipping:" }}
                                </dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                    {{ $this->getRecord()->currency }} {{ get_amount($this->getRecord()->shipping_amount) }}
                                </dd>
                            </dl>
                        @endif

                        <dl class="grid gap-x-3 sm:grid-cols-5">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">{{ "Total:" }}</dt>
                            <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                {{ $this->getRecord()->currency }} {{ get_amount($this->getRecord()->amount) }}
                            </dd>
                        </dl>
                    </div>
                    <!-- End Grid -->
                </div>
            </div>
            <!-- End Flex -->

            @php
                $payments = $this->completedPayments;
            @endphp

            @if ($payments->isNotEmpty())
                <!-- Table -->
                <div class="mt-6">
                    <div class="space-y-4 rounded-lg border border-gray-200 p-4 dark:border-neutral-700">
                        <div class="hidden sm:grid sm:grid-cols-5">
                            <div
                                class="text-xs font-medium text-gray-500 uppercase sm:col-span-2 dark:text-neutral-500"
                            >
                                {{ "Transaction Id" }}
                            </div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ "Gateway" }}
                            </div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ "Amount" }}
                            </div>
                            <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ "Transaction Date" }}
                            </div>
                        </div>

                        <div class="hidden border-b border-gray-200 sm:block dark:border-neutral-700"></div>

                        @foreach ($payments as $payment)
                            <div class="grid grid-cols-3 gap-2 sm:grid-cols-5">
                                <div class="col-span-full sm:col-span-2">
                                    <h5
                                        class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500"
                                    >
                                        {{ "Transaction Id" }}
                                    </h5>
                                    <p class="font-medium break-words text-gray-800 dark:text-neutral-200">
                                        {{ $payment->gateway_transaction_id }}
                                    </p>
                                </div>
                                <div>
                                    <h5
                                        class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500"
                                    >
                                        {{ "Gateway" }}
                                    </h5>
                                    <p class="break-words text-gray-800 dark:text-neutral-200">
                                        {{ $payment->gateway?->display_name }}
                                    </p>
                                </div>
                                <div>
                                    <h5
                                        class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500"
                                    >
                                        {{ "Amount" }}
                                    </h5>
                                    <p class="text-gray-800 dark:text-neutral-200">
                                        {{ $payment->currency }} {{ get_amount($payment->amount) }}
                                    </p>
                                </div>
                                <div>
                                    <h5
                                        class="text-xs font-medium text-gray-500 uppercase sm:hidden dark:text-neutral-500"
                                    >
                                        {{ "Transaction Date" }}
                                    </h5>
                                    <p class="break-words text-gray-800 sm:text-end dark:text-neutral-200">
                                        {{ $payment->created_at->appTimezone()->format("M d Y H:i A") }}
                                    </p>
                                </div>
                            </div>
                            @if (! $loop->last)
                                <div class="border-b border-gray-200 dark:border-neutral-700"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Table -->
            @endif

            @if ($this->getRecord()->notes)
                <!-- Note -->
                <div class="mt-8 border-t border-gray-200 pt-4 sm:mt-12 dark:border-gray-700">
                    <p class="text-gray-500 dark:text-neutral-500">{{ $this->getRecord()->notes }}</p>
                </div>
                <!-- End Note -->
            @endif

            <!-- End Invoice -->
        </x-filament::section>
    </x-filament-panels::page>

    <style type="text/css" media="print">
        .fi-section-content-ctn {
            padding: 0 !important;
            border: none !important;
        }

        .fi-section {
            border: none !important;
            box-shadow: none !important;
        }

        .fi-section-content {
            border: none !important;
            box-shadow: none !important;
        }

        .fi-main {
            margin: 0 !important;
            padding: 0 !important;
            background-color: white !important;
            color: black !important;
        }

        .fi-header {
            display: none;
            !important;
        }

        .fi-topbar {
            display: none;
            !important;
        }

        .fi-sidebar {
            display: none;
            !important;
        }

        .fi-sidebar-close-overlay {
            display: none;
            !important;
        }

        :root {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Optional: if you prefer using the Filament primary var as a first choice */
        .pay-now-print-var {
            background-color: var(--fi-color-primary-600, #2563eb) !important;
            color: #fff !important;
            border-radius: .5rem !important;
            padding: .5rem 1rem !important;
            text-decoration: none !important;
            box-shadow: none !important;
        }
    </style>
</div>
