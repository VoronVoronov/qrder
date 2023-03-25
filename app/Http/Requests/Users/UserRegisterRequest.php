<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'agreement' => 'required|accepted',
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
            'email.required' => __('main.users.register.email.required'),
            'email.email' => __('main.users.register.email.email'),
            'email.unique' => __('main.users.register.email.unique'),
            'phone.required' => __('main.users.register.phone.required'),
            'phone.unique' => __('main.users.register.phone.unique'),
            'password.required' => __('main.users.register.password.required'),
            'password.min' => __('main.users.register.password.min'),
            'password.confirmed' => __('main.users.register.password.confirmed'),
            'agreement.required' => __('main.users.register.agreement.required'),
            'agreement.accepted' => __('main.users.register.agreement.accepted'),
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'email',
            'phone' => 'phone',
            'password' => 'password',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'message' => __('main.validation'),
            'status' => 'error'
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
