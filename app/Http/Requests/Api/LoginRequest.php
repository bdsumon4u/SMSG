<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'scan_data' => 'required|string',
            'device_id' => 'required',
            'device_name' => 'required',
            'device_model' => 'required',
            'android_version' => 'required',
            'app_version' => 'required',
            'sim' => 'required',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $data['sim'] = $this->simData();

        return data_get($data, $key, $default);
    }

    private function simData(): array
    {
        return collect(explode(',', $this->sim))
            ->map(fn ($sim, $key) => [
                'slot' => $key + 1,
                'name' => $sim,
            ])
            ->toArray();
    }
}
