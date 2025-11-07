<?php

namespace Src\SharedKernel\Contracts;

interface DtoContract
{
    public static function fromArray(array $attributes): self;

    public function toArray(): array;
}
