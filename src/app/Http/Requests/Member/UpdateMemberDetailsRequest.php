<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $memberId
 * @property string $email
 */
class UpdateMemberDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Demo says auth not needed
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
            'email' => 'required|email:rfc|unique:\App\Models\MemberDetail,email'
        ];
    }
}
