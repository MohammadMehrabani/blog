<?php

namespace Src\SharedKernel\Providers;

use Src\SharedKernel\Rules\ValidIranMobileFormat;

class BaseServiceProvider extends AbstractServiceProvider
{
    protected array $rules = [
        'valid_iran_mobile_format' => ValidIranMobileFormat::class,
    ];

    protected array $translations = [
        __DIR__.'/../lang' => 'blog',
    ];

    protected array $translationJsons = [
        __DIR__.'/../lang',
    ];
}
