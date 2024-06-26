<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
        $languageId = $this->route('language'); // Assuming the route parameter is named 'language'

        return [
            'name' => 'required|string|max:64',
            'alpha_2_code' => 'required|string|size:2|unique:languages,alpha_2_code,' . $languageId,
        ];
    }
}
