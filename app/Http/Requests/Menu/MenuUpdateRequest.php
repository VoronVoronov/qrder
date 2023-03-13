<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class MenuUpdateRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'nullable|string',
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
            'rate_id.required' => 'Поле "Тариф" обязательно для заполнения',
            'rate_id.integer' => 'Поле "Тариф" должно быть числом',
            'user_id.required' => 'Поле "Пользователь" обязательно для заполнения',
            'user_id.integer' => 'Поле "Пользователь" должно быть числом',
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.string' => 'Поле "Название" должно быть строкой',
            'slug.required' => 'Поле "Ссылка" обязательно для заполнения',
            'slug.string' => 'Поле "Ссылка" должно быть строкой',
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
            'rate_id' => 'Тариф',
            'user_id' => 'Пользователь',
            'name' => 'Название',
            'slug' => 'Ссылка',
            'image' => 'Изображение',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'message' => 'Проверьте правильность введенных данных',
            'status' => 'error'
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
