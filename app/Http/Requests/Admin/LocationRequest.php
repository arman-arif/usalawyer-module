<?php

namespace App\Modules\Lawyer\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locationId = $this->route('location')?->id ?? $this->route('location');

        return [
            'name' => ['required', 'string', 'max:255'],
            'short_code' => ['nullable', 'string', 'max:32'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lawd_locations', 'slug')->ignore($locationId),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
