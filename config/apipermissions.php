<?php

return [
    ROUTE_TYPE_CONFIGURABLE => [
        'admin_section' => [
            'lawyer_categories' => [
                ROUTE_GROUP_READER_ACCESS => [
                    'lawyer.admin.categories.index',
                    'lawyer.admin.categories.show',
                ],
                ROUTE_GROUP_CREATION_ACCESS => [
                    'lawyer.admin.categories.store',
                ],
                ROUTE_GROUP_MODIFIER_ACCESS => [
                    'lawyer.admin.categories.update',
                ],
                ROUTE_GROUP_DELETION_ACCESS => [
                    'lawyer.admin.categories.destroy',
                ],
            ],
            'lawyer_sub_categories' => [
                ROUTE_GROUP_READER_ACCESS => [
                    'lawyer.admin.sub-categories.index',
                    'lawyer.admin.sub-categories.show',
                ],
                ROUTE_GROUP_CREATION_ACCESS => [
                    'lawyer.admin.sub-categories.store',
                ],
                ROUTE_GROUP_MODIFIER_ACCESS => [
                    'lawyer.admin.sub-categories.update',
                ],
                ROUTE_GROUP_DELETION_ACCESS => [
                    'lawyer.admin.sub-categories.destroy',
                ],
            ],
            'lawyer_locations' => [
                ROUTE_GROUP_READER_ACCESS => [
                    'lawyer.admin.locations.index',
                    'lawyer.admin.locations.show',
                ],
                ROUTE_GROUP_CREATION_ACCESS => [
                    'lawyer.admin.locations.store',
                ],
                ROUTE_GROUP_MODIFIER_ACCESS => [
                    'lawyer.admin.locations.update',
                ],
                ROUTE_GROUP_DELETION_ACCESS => [
                    'lawyer.admin.locations.destroy',
                ],
            ],
            'lawyer_lawyers' => [
                ROUTE_GROUP_READER_ACCESS => [
                    'lawyer.admin.lawyers.index',
                    'lawyer.admin.lawyers.show',
                ],
                ROUTE_GROUP_CREATION_ACCESS => [
                    'lawyer.admin.lawyers.store',
                ],
                ROUTE_GROUP_MODIFIER_ACCESS => [
                    'lawyer.admin.lawyers.update',
                ],
                ROUTE_GROUP_DELETION_ACCESS => [
                    'lawyer.admin.lawyers.destroy',
                ],
            ],
        ],
        'user_section' => [

        ],
    ],

    ROUTE_TYPE_ROLE_BASED => [
        USER_ROLE_ADMIN => [

        ],
        USER_ROLE_USER => [

        ]
    ],

    ROUTE_TYPE_AVOIDABLE_MAINTENANCE => [

    ],
    ROUTE_TYPE_AVOIDABLE_UNVERIFIED => [

    ],
    ROUTE_TYPE_AVOIDABLE_INACTIVE => [

    ],
    ROUTE_TYPE_FINANCIAL => [

    ],

    ROUTE_TYPE_GLOBAL => [

    ],
];
