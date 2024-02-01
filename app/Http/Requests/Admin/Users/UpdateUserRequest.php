<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        if (auth()->user()->isAdmin()) {
            $uniqueRule = 'unique:users,username,' . $this->route('user') . ',_id';
        } else {
            $uniqueRule = 'unique:users,username,' . auth()->id() . ',_id';
        }

        return [
            'username' => ['required', 'string', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255', $uniqueRule],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }
}
