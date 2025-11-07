<?php

namespace Src\User\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Src\User\DTOs\UpdateUserAvatarDTO;

class UpdateUserAvatarRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:500'], // max:500kb
        ];
    }

    public function toDTO(): UpdateUserAvatarDTO
    {
        return UpdateUserAvatarDTO::fromArray($this->validated());
    }
}
