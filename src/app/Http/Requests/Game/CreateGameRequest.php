<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $gameDateTime
 * @property array<int,mixed> $player
 */
class CreateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Auth not required for demo
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
            'gameDateTime' => 'required|date',
            'player' => 'required|min:2',
            'player.*.memberId' => 'required|distinct|int|min:1|exists:\App\Models\Member,id',
            'player.*.playerScore' => 'required|int|min:0|max:999',
        ];
    }
}
