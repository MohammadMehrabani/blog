<?php

namespace Src\Post\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Src\Post\DTOs\ListPostsDTO;

class ListPostsRequest extends FormRequest
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
            'per_page' => ['nullable', 'numeric'],
        ];
    }

    public function toDTO(): ListPostsDTO
    {
        return ListPostsDTO::fromArray($this->validated());
    }
}
