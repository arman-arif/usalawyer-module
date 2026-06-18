<?php

namespace App\Modules\Lawyer\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LawyerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'practice_areas' => ['nullable'],
            'practice_areas.*' => ['string', 'max:255'],
            'locations' => ['nullable', 'array'],
            'locations.*' => ['integer', 'exists:lawd_locations,id'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:lawd_categories,id'],
            'sub_categories' => ['nullable', 'array'],
            'sub_categories.*' => ['integer', 'exists:lawd_sub_categories,id'],
            'address' => ['nullable', 'string'],
            'about_overview' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string', 'max:32'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_paid' => ['nullable', 'boolean'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'featured_date_setup' => ['nullable', 'date'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('practice_areas') && is_string($this->input('practice_areas'))) {
            $this->merge([
                'practice_areas' => array_values(array_filter(array_map('trim', preg_split('/[\n,]+/', $this->input('practice_areas'))))),
            ]);
        }

        $this->merge([
            'is_paid' => $this->boolean('is_paid'),
        ]);
    }
}
