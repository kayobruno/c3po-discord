<?php

declare(strict_types=1);

$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);

$builder->addDefinitions(require __DIR__ . '/app.php');

return $builder->build();
