<?php

namespace Src\User\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Src\User\DTOs\UserLoginDTO;

class UserLoginRequest extends FormRequest
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
            'mobile' => ['required', 'string', 'valid_iran_mobile_format'],
            'password' => ['required', 'string'],
        ];
    }

    public function toDTO(): UserLoginDTO
    {
        return UserLoginDTO::fromArray($this->validated());
    }
}
