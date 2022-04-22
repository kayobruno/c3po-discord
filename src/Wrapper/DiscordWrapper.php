<?php

declare(strict_types=1);

namespace App\Wrapper;

use App\Contracts\Wrapper;
use Discord\{Discord};

class DiscordWrapper extends Discord implements Wrapper
{}
