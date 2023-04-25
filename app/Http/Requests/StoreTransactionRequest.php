<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreTransactionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "transaction_id" => "required",
            "token" => "required",
            "transaction_type" => "required|in:D,C",
            "transaction_status" => "required|in:0,1",
            "merchant_code" => "required",
            "merchant_name" => "required",
            "merchant_country" => "required|size:3",
            "currency" => "required|size:3",
            "amount" => "required",
            "transaction_currency" => "required|size:3",
            "transaction_amount" => "required",
            "auth_code" => "required|size:3",
            "transaction_date" => "required"
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator): mixed
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => [
                    'errors' => $errors,
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
