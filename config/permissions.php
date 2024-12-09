<?php

return [
    [
        'name' => 'Applications',
        'flag' => 'applications.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'applications.edit',
        'parent_flag' => 'applications.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'applications.destroy',
        'parent_flag' => 'applications.index',
    ],
];
