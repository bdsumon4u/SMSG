<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'device_id' => ['required', 'exists:devices,id'],
            'number' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
            'sim' => ['required', 'string', 'max:255'],
        ];
    }

    public function slots(): array
    {
        $data = explode('***', $this->validated('sim'), 2);

        return ['number' => $data[0], 'name' => $data[1]];
    }
}
