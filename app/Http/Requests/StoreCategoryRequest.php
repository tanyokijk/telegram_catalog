<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|uuid|exists:categories,id',
            'name' => 'required|string|max:32',
            'slug' => 'required|string|max:71|unique:categories,slug',
            'aliases' => 'required|json',
            'icon' => 'nullable|string',
            'avatar' => 'nullable|string',
            'meta_title' => 'required|string|max:128|unique:categories,meta_title',
            'meta_description' => 'required|string|max:278',
            'image' => 'nullable|string|max:128',
            'image_alt' => 'nullable|string|max:256',
        ];
    }
}
