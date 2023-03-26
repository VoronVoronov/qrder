<?php

return [
    'system' => [
        'registered' => 'User successfully registered',
        'logged_in' => 'User successfully logged in',
        'validation' => 'Check the correctness of the entered data',
        'system_error' => 'System error. Try again later',
        'unauthorized' => 'You are not authorized',
    ],
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
            ],
            'success' => 'You have successfully registered!',
        ],
        'login' => [
            'email' => [
                'required' => 'Email field is required',
                'email' => 'Email must be valid email address',
            ],
            'password' => [
                'required' => 'Password field is required',
                'min' => 'Password must be at least 8 characters',
            ],
            'unauthorized' => 'Phone number or password is incorrect',
            'success' => 'You have successfully logged in!',
            'user_info' => 'User information',
        ],
        'logout' => 'You have successfully logged out!'
    ]
];
