<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'loan_amount' => 'required|integer',
            'duration' => 'required|integer',
            'repayment_frequency' => 'required|integer',
            'interest_rate' => 'required|integer',
            'arrangement_fees' => 'required|integer',
            'loan_type_id' => 'required|string|max:255'
        ];
    }
}
