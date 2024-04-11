<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
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
	        'email' => ['required', 'email:dns', 'string'],
	        'name' => ['required', 'string', 'min:3'],
	        'phone' => ['required', 'min:18'],
	        'password' => ['required', 'min:6', 'confirmed'],
        ];
    }

	public function attributes(): array
	{
		return [
			'email' => 'Электронная почта',
			'name' => 'Имя пользователя',
			'phone' => 'Номер телефона',
			'password' => 'Пароль',
		];
	}

}
