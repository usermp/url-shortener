<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
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
            'link'        => 'required|url',
            'short_link'  => 'required|string',
            'status'      => 'required|in:active,inactive', // Define valid status values
            'description' => 'nullable|string',
            'expire_date' => 'nullable|date',
        ];
    }
}
