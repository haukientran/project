<?php

return [
    [
        'name'      => 'ỨNG DỤNG',
        'menu'      => [
            [
                'name' 		=> 'Dự án',
                'icon' 		=> 'fas fa-user-plus',
                'menu'      => [
                    [
                        'name' 		=> 'Thêm mới',
                        'route' 	=> 'admin.projects.create',
                        'role' 		=> 'projects-create'
                    ],
                    [
                        'name' 		=> 'Danh sách',
                        'route' 	=> 'admin.projects.index',
                        'role' 		=> 'projects-index',
                        'active'    => ['admin.projects.edit'],
                    ],
                ],
            ],
            [
                'name' 		=> 'Thu chi',
                'icon' 		=> 'fas fa-user-plus',
                'menu'      => [
                    [
                        'name' 		=> 'Thêm mới',
                        'route' 	=> 'admin.expenses.create',
                        'role' 		=> 'expenses-create'
                    ],
                    [
                        'name' 		=> 'Danh sách',
                        'route' 	=> 'admin.expenses.index',
                        'role' 		=> 'expenses-index',
                        'active'    => ['admin.expenses.edit'],
                    ],
                ],
            ],
        ]
    ],
];