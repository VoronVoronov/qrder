<?php

return [
    'validation' => 'Check the correctness of the entered data',
    'users' => [
        'register' => [
            'email' => [
                'required' => 'Email field is required',
                'email' => 'Email must be valid email address',
                'unique' => 'User with this email already exists',
            ],
            'phone' => [
                'required' => 'Phone field is required',
                'unique' => 'User with this phone already exists',
            ],
            'password' => [
                'required' => 'Password field is required',
                'min' => 'Password must be at least 8 characters',
                'confirmed' => 'Passwords do not match',
            ],
            'agreement' => [
                'required' => 'Agreement field is required',
                'accepted' => 'Agreement field must be accepted',
            ]
        ],
        'login' => [
            'email' => [
                'required' => 'Email field is required',
                'email' => 'Email must be valid email address',
            ],
            'password' => [
                'required' => 'Password field is required',
                'min' => 'Password must be at least 8 characters',
            ]
        ]
    ]
];
