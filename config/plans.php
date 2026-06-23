<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TamDan Subscription Plans
    |--------------------------------------------------------------------------
    |
    | Limits and features for each plan tier. Update these values to change
    | what appears on the welcome page pricing section.
    |
    */

    'plans' => [
        [
            'slug' => 'starter',
            'name' => 'Starter',
            'price' => 0,
            'period' => '/mo',
            'featured' => false,
            'badge' => null,
            'cta' => 'Choose Starter',
            'summary' => 'For solo freelancers starting out',
            'included' => [
                'Up to 10 clients',
                'Up to 10 projects',
                'Up to 5 quotations',
                'Up to 10 invoices',
                'Up to 20 tasks',
                '1 team member',
                'Business dashboard',
            ],
            'excluded' => [
                'Timeline activities',
                'Role-based permissions',
            ],
        ],
        [
            'slug' => 'professional',
            'name' => 'Professional',
            'price' => 6.99,
            'period' => '/mo',
            'featured' => true,
            'badge' => 'Most Popular',
            'cta' => 'Go Professional',
            'summary' => 'For growing agencies managing more work',
            'included' => [
                'Up to 50 clients',
                'Up to 50 projects',
                'Unlimited quotations',
                'Unlimited invoices',
                'Unlimited tasks',
                'Up to 5 team members',
                'Timeline activities',
                'Invoice & revenue tracking',
            ],
            'excluded' => [
                'Advanced role management',
            ],
        ],
        [
            'slug' => 'enterprise',
            'name' => 'Enterprise',
            'price' => 10,
            'period' => '/mo',
            'featured' => false,
            'badge' => null,
            'cta' => 'Contact Sales',
            'summary' => 'For teams that need full control',
            'included' => [
                'Unlimited clients',
                'Unlimited projects',
                'Unlimited quotations & invoices',
                'Unlimited tasks',
                'Unlimited team members',
                'Timeline activities',
                'Filament Shield roles & permissions',
                'Admin log viewer',
            ],
            'excluded' => [],
        ],
    ],

];
