<?php

return [
    'validation' => 'Проверьте правильность введенных данных',
    'users' => [
        'register' => [
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Поле email должно быть валидным email адресом',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Поле пароль должно быть не менее 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ],
        'login' => [
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Поле email должно быть валидным email адресом',
            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Поле пароль должно быть не менее 8 символов',
        ]
    ]
];
