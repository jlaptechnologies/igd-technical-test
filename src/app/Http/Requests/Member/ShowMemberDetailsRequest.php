<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class ShowMemberDetailsRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'memberId' => $this->route('id'), // Example of input param differing from code param
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // auth not needed for demo as per instructions
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
            'memberId' => 'required|int|min:1|exists:\App\Models\Member,id',
        ];
    }
}
