<?php

namespace App\Http\Requests;

use App\Enums\AccessType;
use App\Enums\ChatType;
use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
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
        return [
            'chat_id' => 'required|integer|unique:chats,chat_id',
            'user_id' => 'required|uuid|exists:users,id',
            'language_id' => 'required|uuid|exists:languages,id',
            'username' => 'required|string|max:32|unique:chats,username',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'access_type' => 'required|in:'.implode(',', AccessType::values()),
            'type' => 'required|in:'.implode(',', ChatType::values()),
            'avatar' => 'nullable|string|max:2048',
            'is_published' => 'boolean',
            'invite_link' => 'nullable|string|max:2048',
            'avg_views' => 'nullable|integer',
            'subscribers' => 'nullable|integer',
            'meta_title' => 'required|string|max:128|unique:chats,meta_title',
            'meta_description' => 'required|string|max:278',
            'image' => 'nullable|string|max:128',
            'image_alt' => 'nullable|string|max:256',
        ];
    }
}
