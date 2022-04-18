<?php

namespace App\Entities;

use App\Contracts\Entity;

abstract class AbstractEntity implements Entity
{
    protected ?string $table = null;
    protected string $primaryKey = 'id';
    protected ?int $id = null;
    protected array $fields = [];

    public function __construct()
    {
        $this->fields[] = $this->primaryKey;
    }

    public function getTableName(): string
    {
        return $this->table ?: $this->formatTableName();
    }

    private function formatTableName(): string
    {
        $className = self::class;
        $words = preg_split('/(?=[A-Z])/', $className);
        $words = array_filter($words);

        return strtolower(implode('_', $words));
    }

    public function __call(string $name, array $args)
    {
        $field = strtolower(substr($name, 3));
        if (preg_match('/^(?!get)/', $name) || !in_array($field, $this->fields)) {
            throw new \BadMethodCallException("Invalid method: {$name}");
        }

        return $this->$field;
    }
}