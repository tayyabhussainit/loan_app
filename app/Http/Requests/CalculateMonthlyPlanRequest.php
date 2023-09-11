<?php

namespace App\Http\Requests;

/**
 * CalculateMonthlyPlanRequest
 * 
 * Request to validate inputs of loan calculater request
 */
class CalculateMonthlyPlanRequest extends BaseApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'loan_amount' => ['required', 'min:1', 'numeric'],
            'annual_interest_rate' => ['required', 'min:1', 'numeric'],
            'loan_term' => ['required', 'min:1'], 'numeric',
            'extra_payment' => ['nullable','regex:/^\d+(\.\d{1,2})?$/', 'numeric']
        ];
    }
}
