<?php

namespace Src\SharedKernel\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class HttpTestCase extends BaseTestCase
{
    protected $defaultHeaders = [
        'accept' => 'application/json',
    ];
}
