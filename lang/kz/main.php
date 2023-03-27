<?php

return [
    'system' => [
        'registered' => 'Пайдаланушы сәтті тіркелді',
        'logged_in' => 'Пайдаланушы сәтті кірді',
        'validation' => 'Енгізілген деректердің дұрыс емесін тексеріңіз',
        'system_error' => 'Серверде қате пайда болды. Кейінірек қайталаңыз.',
        'unauthorized' => 'Сіз тіркелгіңізге рұқсат етілмеген',
    ],
    'users' => [
        'register' => [
            'email' => [
                'required' => 'Электрондық пошта өрісі қажет',
                'email' => 'Электрондық пошта өрісінің мәні дұрыс емес',
                'unique' => 'Бұл электрондық пошта бар',
            ],
            'phone' => [
                'required' => 'Телефон өрісі қажет',
                'unique' => 'Бұл телефон бар',
                'min' => 'Телефон өрісінің мәні 12 таңбадан аз болмауы керек',
                'max' => 'Телефон өрісінің мәні 12 таңбадан көп болмауы керек',
            ],
            'password' => [
                'required' => 'Құпия сөз өрісі қажет',
                'min' => 'Құпия сөз өрісінің мәні 8 таңбадан аз болмауы керек',
                'confirmed' => 'Құпия сөздер сәйкес келмейді',
            ],
            'agreement' => [
                'required' => 'Құпия сөзді растау өрісі қажет',
                'accepted' => 'Құпия сөзді растау өрісін растау керек',
            ],
            'success' => 'Сіз сәтті тіркелдіңіз!',
        ],
        'login' => [
            'email' => [
                'required' => 'Электрондық пошта өрісі қажет',
                'email' => 'Электрондық пошта өрісінің мәні дұрыс емес',
            ],
            'password' => [
                'required' => 'Құпия сөз өрісі қажет',
                'min' => 'Құпия сөз өрісінің мәні 8 таңбадан аз болмауы керек',
            ],
            'phone' => [
                'required' => 'Телефон өрісі қажет',
                'min' => 'Телефон өрісінің мәні 12 таңбадан аз болмауы керек',
                'max' => 'Телефон өрісінің мәні 12 таңбадан көп болмауы керек',
            ],
            'unauthorized' => 'Сіз енгізген телефон нөмірі немесе құпия сөз дұрыс емес',
            'success' => 'Сіз сәтті кірдіңіз!',
            'user_info' => 'Пайдаланушы мәліметтері',
        ],
        'logout' => 'Сіз сәтті шығдыңыз!'
    ],
];
