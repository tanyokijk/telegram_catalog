<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category'); // Assuming the route parameter is named 'category'

        return [
            'parent_id' => 'nullable|uuid|exists:categories,id',
            'name' => 'required|string|max:32',
            'slug' => 'required|string|max:71|unique:categories,slug,' . $categoryId,
            'aliases' => 'required|json',
            'icon' => 'nullable|string',
            'avatar' => 'nullable|string',
            'meta_title' => 'required|string|max:128|unique:categories,meta_title,' . $categoryId,
            'meta_description' => 'required|string|max:278',
            'image' => 'nullable|string|max:128',
            'image_alt' => 'nullable|string|max:256',
        ];
    }
}
