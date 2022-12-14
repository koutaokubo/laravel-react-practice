<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreBook extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'タイトルが未入力です',
            'author.required' => '著者が未入力です',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'message' => "Failed validation",
            "errors" => $errors,
        ], 422, [], JSON_UNESCAPED_UNICODE));
    }
}
