<?php

declare(strict_types=1);

$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);

$builder->addDefinitions(require __DIR__ . '/app.php');
$builder->addDefinitions(require __DIR__ . '/repositories.php');

return $builder->build();
