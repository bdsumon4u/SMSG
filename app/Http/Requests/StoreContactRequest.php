<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): Response|bool
    {
        return Gate::authorize('update', Group::find($this->group_id));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'number' => ['required', 'string', 'max:20'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ];
    }
}
