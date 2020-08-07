<?php

return [
    'models' => [

        'group' => Setting\Models\Group::class,

        'item' => Setting\Models\Item::class,

    ],
    'table_names' => [

        'groups' => 'setting_groups',

        'items' => 'setting_items',
    ],
    'foreign_keys' => [

        'group' => 'setting_group_id',

        'item' => 'setting_item_id',
    ]
];
