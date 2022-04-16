<?php

declare(strict_types=1);

namespace App;

use App\Contracts\Wrapper;

class Kernel
{
    public function __construct(private Wrapper $wrapper)
    {
        $this->wrapper->registerEvents();
    }

    public function run()
    {
        $this->wrapper->run();
    }
}
