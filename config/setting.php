<?php

return [
    'models' => [

        'group' => Setting\SettingGroup::class,

        'item' => Setting\SettingItem::class,

    ],
    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'groups' => 'setting_groups',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'items' => 'setting_items',
    ]
];