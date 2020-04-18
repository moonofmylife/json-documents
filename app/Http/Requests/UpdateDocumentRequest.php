<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdateDocumentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'document.payload' => ['required', 'array']
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->response($validator));
    }

    /**
     * Render the response from server with errors.
     *
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(Validator $validator)
    {
        $failedRules = $validator->failed();

        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        if (isset($failedRules['document.payload']['Required'])) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return response()->json([
            'message' => 'The given data was invalid',
            'errors' => $validator->errors()
        ], $statusCode);
    }
}
