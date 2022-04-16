<?php

declare(strict_types=1);

use App\Kernel;
use Psr\Container\ContainerInterface;

require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->safeLoad();

(function() {
    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    $kernel = $container->get(Kernel::class);
    $kernel->run();
})();
