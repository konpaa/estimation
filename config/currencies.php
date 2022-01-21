<?php

return [
    'supported_currencies' => ['USD', 'RUB', 'EUR', 'BYN'],
    'exchange_rates' => [
        'BYN' => [
            'USD' => ['get' => 2.57, 'set' => 1],
            'EUR' => ['get' => 2.91, 'set' => 1],
            'RUB' => ['get' => 3.32, 'set' => 100],
        ],
        'USD' => [
            'BYN' => ['get' => 1, 'set' => 2.57],
            'EUR' => ['get' => 1, 'set' => 0.89],
            'RUB' => ['get' => 1, 'set' => 77],
        ],
        'EUR' => [
            'BYN' => ['get' => 1, 'set' => 2.91],
            'USD' => ['get' => 1, 'set' => 1.12],
            'RUB' => ['get' => 1, 'set' => 86.36],
        ],
        'RUB' => [
            'BYN' => ['get' => 100, 'set' => 3.32],
            'USD' => ['get' => 77, 'set' => 1],
            'EUR' => ['get' => 86.36, 'set' => 1],
        ]
    ],
];
