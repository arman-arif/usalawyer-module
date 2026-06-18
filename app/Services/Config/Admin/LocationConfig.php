<?php

namespace App\Modules\Lawyer\Services\Config\Admin;

class LocationConfig
{
    public function getConfig($attr = []): array
    {
        return [
            'title' => __('Locations'),
            'fields' => [
                [
                    'key' => 'id',
                    'label' => __('ID'),
                    'is_table_hidden' => true,
                ],
                [
                    'key' => 'name',
                    'label' => __('Name'),
                    'searchable' => true,
                    'orderable' => true,
                ],
                [
                    'key' => 'short_code',
                    'label' => __('Short Code'),
                    'searchable' => true,
                    'orderable' => true,
                    'class' => 'text-center',
                ],
                [
                    'key' => 'slug',
                    'label' => __('Slug'),
                    'searchable' => true,
                    'orderable' => true,
                ],
                [
                    'key' => 'lawyers_count',
                    'label' => __('Lawyers'),
                    'searchable' => false,
                    'orderable' => false,
                    'class' => 'text-center',
                    'formatfn' => fn($item) => (string) ($item->lawyers_count ?? 0),
                ],
                [
                    'key' => 'description',
                    'label' => __('Description'),
                    'searchable' => true,
                    'orderable' => false,
                    'class' => 'always-hidden',
                ],
                [
                    'key' => 'created_at',
                    'label' => __('Created At'),
                    'searchable' => true,
                    'orderable' => true,
                    'class' => 'text-center',
                    'formatfn' => fn($item) => $item->created_at ? $item->created_at->format('Y-m-d') : '',
                ],
            ],
            'actions' => [
                'lawyer.admin.locations.edit' => [
                    'title' => __('Edit'),
                    'icon' => 'laf laf-pencil',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn',
                ],
                'lawyer.admin.locations.destroy' => [
                    'title' => __('Delete'),
                    'icon' => 'laf laf-trash',
                    'method' => 'delete',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn confirmation',
                    'confirm' => __('Are you sure you want to delete this location?'),
                ],
            ],
            'buttons' => [
                'lawyer.admin.locations.create' => [
                    'title' => __('Add New Location'),
                    'icon' => 'laf laf-plus',
                    'class' => 'def-logo-btn-1',
                ],
            ],
            'blades' => [],
            'scripts' => [],
        ];
    }

    public function getFormConfig($attr = []): array
    {
        return [
            'forms' => [
                'create' => [
                    'title' => __('Create Location'),
                    'formMethod' => 'POST',
                    'formAction' => route('lawyer.admin.locations.store'),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.locations.index'),
                            'type' => 'cancel',
                            'icon' => 'laf laf-cross',
                        ],
                        [
                            'title' => __('Save'),
                            'type' => 'submit',
                            'icon' => 'laf laf-check',
                        ],
                    ],
                ],
                'edit' => [
                    'title' => __('Edit Location'),
                    'formMethod' => 'PUT',
                    'formAction' => route('lawyer.admin.locations.update', $attr['id'] ?? 0),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.locations.index'),
                            'type' => 'cancel',
                            'icon' => 'laf laf-cross',
                        ],
                        [
                            'title' => __('Update'),
                            'type' => 'submit',
                            'icon' => 'laf laf-check',
                        ],
                    ],
                ],
            ],
            'fields' => [
                [
                    [
                        'key' => 'name',
                        'label' => __('Name'),
                        'type' => 'text',
                        'required' => true,
                        'col' => 6,
                        'onchange' => 'slug',
                        'onchange_target' => 'slug',
                    ],
                    [
                        'key' => 'short_code',
                        'label' => __('Short Code'),
                        'type' => 'text',
                        'required' => false,
                        'col' => 6,
                    ],
                ],
                [
                    [
                        'key' => 'slug',
                        'label' => __('Slug'),
                        'type' => 'text',
                        'required' => true,
                        'col' => 12,
                    ],
                ],
                [
                    [
                        'key' => 'description',
                        'label' => __('Description'),
                        'type' => 'textarea',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
            ],
            'buttons' => [
                'lawyer.admin.locations.index' => [
                    'title' => __('Back to list'),
                    'icon' => 'laf laf-caret-left',
                    'class' => 'def-logo-btn-1',
                ],
            ],
            'scripts' => [],
        ];
    }
}
