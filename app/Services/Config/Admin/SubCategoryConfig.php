<?php

namespace App\Modules\Lawyer\Services\Config\Admin;

use App\Modules\Lawyer\Models\Category;

class SubCategoryConfig
{
    public function getConfig($attr = []): array
    {
        return [
            'title' => __('Sub-categories'),
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
                    'key' => 'category.name',
                    'label' => __('Category'),
                    'searchable' => true,
                    'orderable' => true,
                    'formatfn' => fn($item) => $item->category?->name ?? '',
                ],
                [
                    'key' => 'slug',
                    'label' => __('Slug'),
                    'searchable' => true,
                    'orderable' => true,
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
                'lawyer.admin.sub-categories.edit' => [
                    'title' => __('Edit'),
                    'icon' => 'laf laf-pencil',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn',
                ],
                'lawyer.admin.sub-categories.destroy' => [
                    'title' => __('Delete'),
                    'icon' => 'laf laf-trash',
                    'method' => 'delete',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn confirmation',
                    'confirm' => __('Are you sure you want to delete this sub-category?'),
                ],
            ],
            'buttons' => [
                'lawyer.admin.sub-categories.create' => [
                    'title' => __('Add New Sub-category'),
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
        $categories = Category::query()
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn($c) => ['key' => $c->id, 'label' => $c->name])
            ->all();

        return [
            'forms' => [
                'create' => [
                    'title' => __('Create Sub-category'),
                    'formMethod' => 'POST',
                    'formAction' => route('lawyer.admin.sub-categories.store'),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.sub-categories.index'),
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
                    'title' => __('Edit Sub-category'),
                    'formMethod' => 'PUT',
                    'formAction' => route('lawyer.admin.sub-categories.update', $attr['id'] ?? 0),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.sub-categories.index'),
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
                        'key' => 'category_id',
                        'label' => __('Category'),
                        'type' => 'select',
                        'required' => true,
                        'col' => 12,
                        'options' => [
                            'data' => $categories,
                            'key' => 'key',
                            'label' => 'label',
                        ],
                    ],
                ],
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
                        'key' => 'slug',
                        'label' => __('Slug'),
                        'type' => 'text',
                        'required' => true,
                        'col' => 6,
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
                'lawyer.admin.sub-categories.index' => [
                    'title' => __('Back to list'),
                    'icon' => 'laf laf-caret-left',
                    'class' => 'def-logo-btn-1',
                ],
            ],
            'scripts' => [],
        ];
    }
}
