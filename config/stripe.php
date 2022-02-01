<?php

return [

    'public' => env('STRIPE_KEY', ''),
    'secret' => env('STRIPE_SECRET', ''),
    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET'),
        'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
    ],
    'plan' => env('STRIPE_PLAN_ID', ''),
];
