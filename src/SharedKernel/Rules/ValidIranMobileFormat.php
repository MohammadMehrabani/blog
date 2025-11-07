<?php

namespace Src\SharedKernel\Rules;

class ValidIranMobileFormat extends AbstractRule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^(09)(\d{9})$/', $value);
    }

    public function message(): string
    {
        return trans('validation.regex');
    }
}
