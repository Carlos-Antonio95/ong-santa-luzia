<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'theme' => 'nullable|in:light,dark',
            'notifications_enabled' => 'nullable|boolean',
            'language' => 'nullable|in:pt_BR,en_US',
            'preferences' => 'nullable|array',
        ];
    }
}
