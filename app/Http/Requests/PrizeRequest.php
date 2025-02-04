<?php

namespace App\Http\Requests;

use App\Models\Prize;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PrizeRequest extends FormRequest
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
            'title' => 'required|string|max:200',
            'probability' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
                function ($attribute, $value, $fail) {
                    // Check if the provided value is numeric
                    if (!is_numeric($value)) {
                        $fail("The $attribute must be a valid number.");
                        return; // Stop further validation if not numeric
                    }
                    $prizeId = @$this->route('id'); // Adjust the route name if different
                    if(!is_null($prizeId)){
                    // Get total probability excluding current prize (for updates)
                    $currentTotalProbability = Prize::where('id', '!=', $prizeId)->sum('probability');
                    }else{
                    // Get the total probability excluding current prize (for updates)
                    $currentTotalProbability = Prize::sum('probability');
                    }
                    // Check if total probability exceeds 100%
                    if (($currentTotalProbability + $value) > 100) {
                        $fail("The probability field must not be greater than ".(100-$currentTotalProbability)."%.");
                    }
                },
            ],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'probability.required' => 'Probability is required!',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 201));
    }

}
