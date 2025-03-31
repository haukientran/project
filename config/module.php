<?php

return [
    'permissions' => [
        'index' => 'Truy cập',
        'create' => 'Thêm',
        'show' => 'Xem',
        'edit' => 'Sửa',
        'delete' => 'Xóa',
        // 'restore' => 'Lấy lại',
    ],
	'modules' => [
		'projects' => [
			'name' 			=> 'Dự án',
			'permissions'	=> [
				[ 'type' => 'index' ],
				[ 'type' => 'create' ],
				[ 'type' => 'edit' ],
				// [ 'type' => 'restore' ],
				[ 'type' => 'delete' ],
			],
		],
		'expenses' => [
			'name' 			=> 'Thu chi',
			'permissions'	=> [
				[ 'type' => 'index' ],
				[ 'type' => 'create' ],
				[ 'type' => 'edit' ],
				// [ 'type' => 'restore' ],
				[ 'type' => 'delete' ],
			],
		]
    ]
];