<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 */
class ShowGameRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

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
            'id' => 'required|int|min:1|exists:\App\Models\Game,id',
        ];
    }
}
