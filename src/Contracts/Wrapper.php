<?php

declare(strict_types=1);

namespace App\Contracts;

interface Wrapper
{
    public function on(string $event, callable $listener);
    public function run(): void;
}