<?php

declare(strict_types=1);

return [
    'title' => [
        'default' => 'Secure Checkout',
        'payment_success' => 'Payment Successful',
        'payment_pending' => 'Payment Pending',
        'payment_cancelled' => 'Payment Cancelled',
    ],

    'alert' => [
        'something_went_wrong' => 'Something went wrong, Please try again.',
        'limit_error' => 'Amount must be between :min :currency and :max :currency',
        'limit_error_unlimited' => 'Amount must be at least :min :currency',
        'transaction_exist' => 'The transaction id has already been used.',
        'less_amount' => 'Transaction amount is less than the required payment amount.',
        'more_amount' => 'Transaction amount is more than the required payment amount.',
        'transaction_not_found' => 'Transaction verification failed. Please try again later or contact support with your transaction ID',
        'customer_blocked' => 'You are unable to make payments at this time. Please contact support.',
        'payment_timeout_expired' => 'Your payment verification time has expired. This transaction will need to be manually verified by our team. Please contact support with your Transaction ID: :trx_id',
        'transaction_processing' => 'Your transaction is being processed. Please wait a moment and try again.',
        'selection_in_progress' => 'Please wait a moment before switching your payment method.',
        'gateway_paused' => ':name is unavailable between :from and :until. Please choose another payment method or try again after :until.',
    ],

    'form' => [
        'full_name' => 'Full Name',
        'email' => 'Email',
        'phone' => 'Mobile Number',
        'amount' => 'Amount',
        'reference' => 'Reference (optional)',
        'submit' => 'Submit',
    ],

    'liquid' => [

        'reseller_id' => 'Reseller ID',
    ],

    'home' => [
        'support' => 'Support',
        'faq' => 'FAQ',
        'details' => 'Details',

        'select_payment_method' => 'Select Payment Method',
        'mobile_banking' => 'MOBILE BANKING',
        'global' => 'GLOBAL',
        'bank_transfer' => 'BANK TRANSFER',

        'pay' => 'Pay',
    ],

    'support' => [
        'phone_number' => 'tel::phone_number',
        'number' => 'Number',
        'number_details' => 'Click here to Call us for support.',

        'messenger_link' => 'https://m.me/:messenger_link',
        'messenger' => 'Messenger',
        'messenger_details' => 'Click here for Messenger live chat.',

        'whatsapp_number' => 'https://wa.me/:whatsapp_number',
        'whatsapp' => 'Whatsapp',
        'whatsapp_details' => 'Click here for Whatsapp live support.',

        'support_mail' => 'mailto::support_mail',
        'support_email' => 'Email',
        'email_details' => 'Click here to Email us for support.',

        'telegram_link' => 'https://t.me/:telegram_link',
        'telegram' => 'Telegram',
        'telegram_details' => 'Click here for Telegram live support.',

        'support_link' => 'https://:support_link',
        'support_ticket' => 'Support Ticket',
        'support_ticket_details' => 'Click here to create a Support Ticket.',
    ],

    'details' => [
        'title' => 'Transaction Details',
        'name' => 'Name:',
        'email' => 'Email:',
        'amount' => 'Amount:',
        'fee' => 'Fee:',
        'additional_fee' => 'Additional Fees May Apply',
        'total_amount' => 'Total Payable Amount:',
    ],

    'common' => [
        'waiting' => 'Waiting for your payment...',
        'expired' => 'Payment window expired. If you already paid, it will be verified shortly — otherwise please contact support.',
        'multiple_match' => 'Multiple deposits match this amount. Please contact support to verify your payment.',
        'busy' => 'This gateway is busy at this moment. Please try again later or select another gateway.',
        'proof_pending' => 'Payment proof submitted, awaiting verification.',
        'proof_invalid' => 'Upload a clear copy of your payment confirmation (:types, up to :size MB).',
        'pay_with' => 'Pay with :name',
        'do_not_close' => "Please do not close this page. We will automatically verify your payment once it's completed.",
        'verified' => 'Payment verified! Redirecting...',
        'time_left' => ':time left',
        'charge' => ':amount fees included',
        'discount' => ':amount discount applied',
        'copy' => 'Copy',
        'enter_amount' => 'Enter the Amount: :amount',
        'confirm' => 'Complete The Payment',
        'note' => 'Note: Please verify within :minutes minutes of making your payment',
        'verify' => 'Verify',
        'contested' => 'This payment could not be verified automatically because another checkout is using the same number and amount. Please submit your Transaction ID.',
    ],

    'mfs' => [

        'number_saved' => 'Number saved.',
        'number_required' => 'Enter the number you are sending from first.',
        'show_qr' => 'Show QR',
        'close' => 'Close',

        'transaction_id' => 'Transaction ID',
        'enter_transaction_id' => 'Enter Transaction ID',
        'phone_number' => 'Phone Number',
        'enter_phone_number' => 'Enter Phone Number',

        'open_app' => 'Go to your :method Mobile App.',
        'choose_type' => 'Choose: :account_type',
        'enter_number' => 'Enter the Number: :number',

        'enter_pin' => 'Now enter your :method PIN to confirm.',
        'enter_transaction' => 'Put the :transaction_id in the box bellow and press :verify',

    ],

    'bank_transfer' => [

        'instructions' => 'Transfer exactly the amount below to the account shown.',
        'bank_name' => 'Bank',
        'account_name' => 'Account Name',
        'account_number' => 'Account Number',
        'branch_name' => 'Branch',
        'routing_number' => 'Routing Number',
        'swift_code' => 'SWIFT/BIC Code',
    ],

    'banglaqr' => [

        'flow' => 'Open App → Scan QR → Confirm',
    ],

    'binance' => [
        'open_app' => 'Open Binance App → Pay → Send to Binance User or :link',
        'send_to' => 'Send to Binance ID: :binance_id',
        'order_id' => 'Order ID',
        'enter_order_id' => 'Enter Order ID',
        'enter_order_id_instruction' => 'Enter the :order_id in the box bellow and click :verify',
    ],

    'bybit' => [
        'open_app' => 'Open Bybit App → Assets → Withdraw → Crypto withdrawal → Select :currency Currency → Internal Transfer → Send to Bybit UID or :link',
        'send_to' => 'Send to Bybit UID: :bybit_id',
        'transaction_id' => 'Transaction Hash',
        'enter_transaction_id' => 'Enter Transaction Hash',
        'enter_transaction_id_instruction' => 'Enter the :transaction_id in the box bellow and click :verify',
    ],

    'complete' => [
        'congratulations' => 'Congratulations!',
        'oops' => 'Oops!',
        'cancelled' => 'Payment cancelled !',
        'success_thank_you' => 'Thanks for your payment!',
        'pending_thank_you' => 'Your payment will be verified manually.',
        'cancel_thank_you' => 'You have cancelled this Payment.',
        'return_to_website' => 'Return to Website !',

        'payment_info' => 'Payment Information',
        'payment_method' => 'Payment Method:',
        'phone_number' => 'Phone Number:',
        'transaction_id' => 'Transaction ID:',
        'amount' => 'Amount:',
        'status' => 'Status:',
    ],
];
