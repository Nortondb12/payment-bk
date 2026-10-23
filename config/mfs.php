<?php

declare(strict_types=1);

return [
    'bkash' => [
        'name' => 'bKash',
        'ussd' => '*247#',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'rocket' => [
        'name' => 'Rocket',
        'ussd' => '*322#',
        'number_length' => 12,
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'nagad' => [
        'name' => 'Nagad',
        'ussd' => '*167#',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'upay' => [
        'name' => 'Upay',
        'ussd' => '*268#',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'cellfin' => [
        'name' => 'Cellfin',
        'ussd' => '',
        'mode' => [
            'personal' => 'Fund Transfer',
            'merchant' => 'Fund Transfer',
            'agent' => 'Cash Withdraw',
        ],
    ],

    'tap' => [
        'name' => 'Tap',
        'ussd' => '*733#',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'okwallet' => [
        'name' => 'OK Wallet',
        'ussd' => '*269#',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'ipay' => [
        'name' => 'iPay',
        'ussd' => '',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'pathaopay' => [
        'name' => 'Pathao Pay',
        'ussd' => '',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'vodafone' => [
        'name' => 'Vodafone',
        'ussd' => '',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],

    'dgepay' => [
        'name' => 'DgePay',
        'ussd' => '',
        'mode' => [
            'personal' => 'Send Money',
            'merchant' => 'Payment',
            'agent' => 'Cash Out',
        ],
    ],
];
