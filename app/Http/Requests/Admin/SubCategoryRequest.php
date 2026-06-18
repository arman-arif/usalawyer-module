<?php

namespace App\Modules\Lawyer\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $subCategoryId = $this->route('sub_category')?->id ?? $this->route('sub_category');

        return [
            'category_id' => ['required', 'integer', 'exists:lawd_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lawd_sub_categories', 'slug')->ignore($subCategoryId),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
