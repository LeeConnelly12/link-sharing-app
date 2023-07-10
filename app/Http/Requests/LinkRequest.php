<?php

namespace App\Http\Requests;

use App\Enums\Platform;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'links' => ['nullable', 'array'],
            'links.*.platform' => ['required', new Enum(Platform::class)],
            'links.*.url' => ['required', 'url', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'links.*.platform.required' => 'Can\'t be empty',
            'links.*.platform.enum' => 'Invalid platform',
            'links.*.url.required' => 'Can\'t be empty',
            'links.*.url.url' => 'Please check the URL',
            'links.*.url.max' => 'Must be less than 255 characters',
        ];
    }
}
