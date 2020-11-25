<?php

return [
    'name' => 'Users',
    'menu' => [
        [
            'name' => 'Administracion',
            'type' => 'header',
            'icon' => 'fa fa-id-card',
            'route' => 'panel.users.index',
            'attribute' => [
                'class' => 'bg-navy'
            ],
            'authorization' => [
                'admin'
            ],
            'submenu' => [[
                'name' => 'Usuarios',
                'icon' => 'fa fa-users',
                'type' => 'item',
                'route' => 'panel.users.index',
                'attribute' => [
                    'class' => ''
                ],
                'authorization' => [
                    'admin'
                ]
            ]]
        ]
    ]
];
