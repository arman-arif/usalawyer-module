<?php

namespace App\Modules\Lawyer\Services\Config\Admin;

use App\Modules\Lawyer\Models\Location;

class LawyerConfig
{
    public function getConfig($attr = []): array
    {
        return [
            'title' => __('Lawyers'),
            'fields' => [
                [
                    'key' => 'id',
                    'label' => __('ID'),
                    'is_table_hidden' => true,
                ],
                [
                    'key' => 'photo',
                    'label' => __('Photo'),
                    'searchable' => false,
                    'orderable' => false,
                    'class' => 'text-center',
                    'formatfn' => fn($item) => $item->photo
                        ? '<img src="'.asset('storage/'.$item->photo).'" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:50%;">'
                        : '',
                ],
                [
                    'key' => 'name',
                    'label' => __('Name'),
                    'searchable' => true,
                    'orderable' => true,
                ],
                [
                    'key' => 'location_rel.name',
                    'label' => __('Location'),
                    'searchable' => true,
                    'orderable' => true,
                    'formatfn' => fn($item) => $item->locationRel?->name ?? '',
                ],
                [
                    'key' => 'contact_number',
                    'label' => __('Contact'),
                    'searchable' => true,
                    'orderable' => true,
                ],
                [
                    'key' => 'email',
                    'label' => __('Email'),
                    'searchable' => true,
                    'orderable' => true,
                    'class' => 'always-hidden',
                ],
                [
                    'key' => 'is_paid',
                    'label' => __('Paid'),
                    'searchable' => true,
                    'orderable' => true,
                    'class' => 'text-center',
                    'formatfn' => fn($item) => $item->is_paid
                        ? '<span class="badge bg-success">'.__('Yes').'</span>'
                        : '<span class="badge bg-secondary">'.__('No').'</span>',
                ],
                [
                    'key' => 'practice_areas',
                    'label' => __('Practice Areas'),
                    'searchable' => false,
                    'orderable' => false,
                    'class' => 'always-hidden',
                    'formatfn' => fn($item) => is_array($item->practice_areas) ? implode(', ', $item->practice_areas) : '',
                ],
                [
                    'key' => 'featured_date_setup',
                    'label' => __('Featured Until'),
                    'searchable' => true,
                    'orderable' => true,
                    'class' => 'text-center',
                    'formatfn' => fn($item) => $item->featured_date_setup ? $item->featured_date_setup->format('Y-m-d') : '',
                ],
            ],
            'actions' => [
                'lawyer.admin.lawyers.edit' => [
                    'title' => __('Edit'),
                    'icon' => 'laf laf-pencil',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn',
                ],
                'lawyer.admin.lawyers.destroy' => [
                    'title' => __('Delete'),
                    'icon' => 'laf laf-trash',
                    'method' => 'delete',
                    'parameter' => fn($item) => [$item->id],
                    'class' => 'tooltip-container group action-btn confirmation',
                    'confirm' => __('Are you sure you want to delete this lawyer?'),
                ],
            ],
            'buttons' => [
                'lawyer.admin.lawyers.create' => [
                    'title' => __('Add New Lawyer'),
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
        $locations = Location::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return [
            'forms' => [
                'create' => [
                    'title' => __('Create Lawyer'),
                    'formMethod' => 'POST',
                    'formAction' => route('lawyer.admin.lawyers.store'),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.lawyers.index'),
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
                    'title' => __('Edit Lawyer'),
                    'formMethod' => 'PUT',
                    'formAction' => route('lawyer.admin.lawyers.update', $attr['id'] ?? 0),
                    'formButton' => [
                        [
                            'title' => __('Cancel'),
                            'href' => route('lawyer.admin.lawyers.index'),
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
                        'col' => 8,
                    ],
                    [
                        'key' => 'is_paid',
                        'label' => __('Paid Listing'),
                        'type' => 'radio',
                        'required' => false,
                        'col' => 4,
                        'options' => [
                            'data' => [
                                ['key' => 1, 'label' => __('Yes')],
                                ['key' => 0, 'label' => __('No')],
                            ],
                        ],
                    ],
                ],
                [
                    [
                        'key' => 'photo',
                        'label' => __('Photo'),
                        'type' => 'file',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
                [
                    [
                        'key' => 'practice_areas',
                        'label' => __('Practice Areas'),
                        'type' => 'tags',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
                [
                    [
                        'key' => 'location',
                        'label' => __('Location'),
                        'type' => 'select',
                        'required' => false,
                        'col' => 6,
                        'options' => [
                            'data' => $locations,
                            'key' => 'id',
                            'label' => 'name',
                        ],
                    ],
                    [
                        'key' => 'featured_date_setup',
                        'label' => __('Featured Until'),
                        'type' => 'date',
                        'required' => false,
                        'col' => 6,
                    ],
                ],
                [
                    [
                        'key' => 'address',
                        'label' => __('Address'),
                        'type' => 'textarea',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
                [
                    [
                        'key' => 'about_overview',
                        'label' => __('About Overview'),
                        'type' => 'textarea',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
                [
                    [
                        'key' => 'contact_number',
                        'label' => __('Contact Number'),
                        'type' => 'tel',
                        'required' => false,
                        'col' => 6,
                    ],
                    [
                        'key' => 'email',
                        'label' => __('Email'),
                        'type' => 'email',
                        'required' => false,
                        'col' => 6,
                    ],
                ],
                [
                    [
                        'key' => 'website_url',
                        'label' => __('Website URL'),
                        'type' => 'url',
                        'required' => false,
                        'col' => 12,
                    ],
                ],
            ],
            'buttons' => [
                'lawyer.admin.lawyers.index' => [
                    'title' => __('Back to list'),
                    'icon' => 'laf laf-caret-left',
                    'class' => 'def-logo-btn-1',
                ],
            ],
            'scripts' => [],
        ];
    }
}
