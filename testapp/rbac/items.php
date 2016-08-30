<?php
return [
    'MeasureAdministrator' => [
        'type' => 1,
        'description' => 'This role allows to manage a measures extension',
        'children' => [
            'measure-view-measure',
            'measure-create-measure',
            'measure-edit-measure',
            'measure-delete-measure',
        ],
    ],
    'measure-view-measure' => [
        'type' => 2,
        'description' => 'You can see measures list and measure details',
    ],
    'measure-create-measure' => [
        'type' => 2,
        'description' => 'You can create a new measure',
    ],
    'measure-edit-measure' => [
        'type' => 2,
        'description' => 'You can edit an existing measure',
    ],
    'measure-delete-measure' => [
        'type' => 2,
        'description' => 'You can delete a measure',
    ],
];
