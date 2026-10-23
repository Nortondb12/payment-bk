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
        'something_went_wrong' => 'কিছু ভুল হয়েছে, আবার চেষ্টা করুন।',
        'limit_error' => 'পরিমাণ অবশ্যই :min :currency এবং :max :currency এর মধ্যে হতে হবে।',
        'limit_error_unlimited' => 'পরিমাণ অবশ্যই কমপক্ষে :min :currency হতে হবে।',
        'transaction_exist' => 'এই Transaction ID ইতোমধ্যে ব্যবহার করা হয়েছে।',
        'less_amount' => 'আপনি প্রয়োজনীয় পরিমাণের চেয়ে কম প্রদান করেছেন।',
        'more_amount' => 'আপনি প্রয়োজনীয় পরিমাণের চেয়ে বেশি প্রদান করেছেন।',
        'transaction_not_found' => 'দুঃখিত, আপনার ট্রানজেকশন আইডি খুঁজে পাওয়া যায়নি। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন অথবা আপনার ট্রানজেকশন আইডি সহ আমাদের সাপোর্টে যোগাযোগ করুন।',
        'customer_blocked' => 'আপনি এই মুহূর্তে পেমেন্ট করতে পারবেন না। অনুগ্রহ করে সাপোর্টে যোগাযোগ করুন।',
        'payment_timeout_expired' => 'আপনার পেমেন্ট যাচাইয়ের সময়সীমা শেষ হয়ে গেছে। এই ট্রানজেকশনটি আমাদের টিম ম্যানুয়ালি যাচাই করবে। অনুগ্রহ করে আপনার ট্রানজেকশন আইডি :trx_id সহ সাপোর্টে যোগাযোগ করুন।',
        'transaction_processing' => 'আপনার ট্রানজেকশন প্রক্রিয়াধীন। অনুগ্রহ করে কিছুক্ষণ অপেক্ষা করুন এবং আবার চেষ্টা করুন।',
        'selection_in_progress' => 'পেমেন্ট মেথড পরিবর্তন করার আগে অনুগ্রহ করে কিছুক্ষণ অপেক্ষা করুন।',
        'gateway_paused' => ':from থেকে :until পর্যন্ত :name বন্ধ থাকে। অনুগ্রহ করে অন্য একটি পেমেন্ট মাধ্যম বেছে নিন অথবা :until এর পর আবার চেষ্টা করুন।',
    ],

    'form' => [
        'full_name' => 'সম্পূর্ণ নাম',
        'email' => 'ইমেইল',
        'phone' => 'মোবাইল নম্বর',
        'amount' => 'টাকার পরিমাণ',
        'reference' => 'রেফারেন্স (ঐচ্ছিক)',
        'submit' => 'Submit',
    ],

    'liquid' => [

        'reseller_id' => 'রিসেলার আইডি',
    ],

    'home' => [
        'support' => 'সহায়তা',
        'faq' => 'প্রশ্নাবলী',
        'details' => 'বিস্তারিত',

        'select_payment_method' => 'পেমেন্ট পদ্ধতি নির্বাচন করুন',
        'mobile_banking' => 'মোবাইল ব্যাংকিং',
        'global' => 'ইন্টারন্যাশনাল',
        'bank_transfer' => 'ব্যাংক ট্রান্সফার',

        'pay' => 'Pay',
    ],

    'support' => [
        'phone_number' => 'tel::phone_number',
        'number' => 'নম্বর',
        'number_details' => 'সহায়তার জন্য আমাদের কল করতে এখানে ক্লিক করুন।',

        'messenger_link' => 'https://m.me/:messenger_link',
        'messenger' => 'মেসেঞ্জার',
        'messenger_details' => 'মেসেঞ্জার লাইভ চ্যাটের জন্য এখানে ক্লিক করুন।',

        'whatsapp_number' => 'https://wa.me/:whatsapp_number',
        'whatsapp' => 'হোয়াটসঅ্যাপ',
        'whatsapp_details' => 'হোয়াটসঅ্যাপে লাইভ সহায়তার জন্য এখানে ক্লিক করুন।',

        'support_mail' => 'mailto::support_mail',
        'support_email' => 'ইমেইল',
        'email_details' => 'সহায়তার জন্য আমাদের ইমেইল করতে এখানে ক্লিক করুন।',

        'telegram_link' => 'https://t.me/:telegram_link',
        'telegram' => 'টেলিগ্রাম',
        'telegram_details' => 'টেলিগ্রামে লাইভ সহায়তার জন্য এখানে ক্লিক করুন।',

        'support_link' => 'https://:support_link',
        'support_ticket' => 'সাপোর্ট টিকেট',
        'support_ticket_details' => 'সাপোর্ট টিকেট তৈরি করতে এখানে ক্লিক করুন।',
    ],

    'details' => [
        'title' => 'লেনদেনের বিস্তারিত',
        'name' => 'নামঃ',
        'email' => 'ইমেইলঃ',
        'amount' => 'পরিমাণঃ',
        'fee' => 'ফিঃ',
        'additional_fee' => 'অতিরিক্ত ফি প্রযোজ্য হতে পারে',
        'total_amount' => 'মোট পরিমাণঃ',
    ],

    'common' => [
        'waiting' => 'আপনার পেমেন্টের জন্য অপেক্ষা করা হচ্ছে...',
        'expired' => 'পেমেন্টের সময় শেষ হয়েছে। যদি আপনি ইতিমধ্যে পরিশোধ করে থাকেন, শীঘ্রই যাচাই হবে — অন্যথায় সাপোর্টে যোগাযোগ করুন।',
        'multiple_match' => 'একাধিক ডিপোজিট এই পরিমাণের সাথে মিলেছে। যাচাইয়ের জন্য সাপোর্টে যোগাযোগ করুন।',
        'busy' => 'এই গেটওয়েটি এই মুহূর্তে ব্যস্ত। পরে আবার চেষ্টা করুন অথবা অন্য গেটওয়ে নির্বাচন করুন।',
        'proof_pending' => 'পেমেন্ট প্রমাণ জমা হয়েছে, যাচাইয়ের অপেক্ষায়।',
        'proof_invalid' => 'আপনার পেমেন্ট নিশ্চিতকরণের স্পষ্ট কপি আপলোড করুন (:types, সর্বোচ্চ :size MB)।',
        'pay_with' => ':name দিয়ে পরিশোধ করুন',
        'do_not_close' => 'অনুগ্রহ করে এই পেজটি বন্ধ করবেন না। পেমেন্ট সম্পন্ন হলে আমরা স্বয়ংক্রিয়ভাবে যাচাই করব।',
        'verified' => 'পেমেন্ট যাচাই হয়েছে! রিডাইরেক্ট করা হচ্ছে...',
        'time_left' => ':time বাকি',
        'charge' => ':amount ফি অন্তর্ভুক্ত',
        'discount' => ':amount ছাড়',
        'copy' => 'কপি করুন',
        'enter_amount' => 'টাকার পরিমাণঃ :amount',
        'contested' => 'একই নম্বর ও পরিমাণে আরেকটি চেকআউট চলমান থাকায় পেমেন্টটি স্বয়ংক্রিয়ভাবে যাচাই করা যায়নি। অনুগ্রহ করে আপনার ট্রানজেকশন আইডি দিন।',
    ],

    'mfs' => [

        'number_saved' => 'নম্বর সংরক্ষণ করা হয়েছে।',
        'number_required' => 'প্রথমে আপনি যে নম্বর থেকে পাঠাচ্ছেন সেটি লিখুন।',
        'show_qr' => 'কিউআর দেখান',
        'close' => 'বন্ধ করুন',

        'transaction_id' => 'Transaction ID',
        'enter_transaction_id' => 'ট্রানজেকশন আইডি লিখুন',
        'phone_number' => 'ফোন নম্বর',
        'enter_phone_number' => 'ফোন নম্বর লিখুন',

        'open_app' => 'আপনার :method মোবাইল অ্যাপে যান।',
        'choose_type' => ':account_type -এ ক্লিক করুন।',
        'enter_number' => 'প্রাপক নম্বর হিসেবে এই নম্বরটি লিখুনঃ :number',

        'enter_pin' => 'নিশ্চিত করতে এখন আপনার :method পিন লিখুন।',
        'enter_transaction' => 'এখন নিচের বক্সে আপনার :transaction_id দিন এবং নিচের :verify বাটনে ক্লিক করুন।',

    ],

    'bank_transfer' => [

        'instructions' => 'নিচের অ্যাকাউন্টে ঠিক পরিমাণটি পাঠান।',
        'bank_name' => 'ব্যাংক',
        'account_name' => 'অ্যাকাউন্টের নাম',
        'account_number' => 'অ্যাকাউন্ট নম্বর',
        'branch_name' => 'শাখা',
        'routing_number' => 'রাউটিং নম্বর',
        'swift_code' => 'সুইফট/বিআইসি কোড',
    ],

    'banglaqr' => [

        'flow' => 'অ্যাপ খুলুন → কিউআর স্ক্যান → নিশ্চিত করুন',
    ],

    'complete' => [
        'congratulations' => 'অভিনন্দন!',
        'oops' => 'Oops!',
        'cancelled' => 'পেমেন্ট বাতিল!',
        'success_thank_you' => 'আপনার পেমেন্টের জন্য ধন্যবাদ!',
        'pending_thank_you' => 'আপনার পেমেন্ট ম্যানুয়ালি যাচাই করা হবে।',
        'cancel_thank_you' => 'আপনি পেমেন্ট বাতিল করেছেন।',
        'return_to_website' => 'ওয়েবসাইটে ফিরে যান!',

        'payment_info' => 'পেমেন্টের তথ্য',
        'payment_method' => 'পেমেন্ট পদ্ধতিঃ',
        'phone_number' => 'ফোন নম্বরঃ',
        'transaction_id' => 'ট্রানজেকশন আইডিঃ',
        'amount' => 'পরিমাণঃ',
        'status' => 'অবস্থাঃ',
    ],
];
