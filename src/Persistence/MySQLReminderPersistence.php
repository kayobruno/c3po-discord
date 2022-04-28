<?php

declare(strict_types=1);

namespace App\Persistence;

use App\Contracts\Persistence;
use App\Database\MySQL;
use PDO;

class MySQLReminderPersistence implements Persistence
{
    private ?PDO $conn = null;
    private string $table = 'reminder';

    public function __construct()
    {
        $this->conn = MySQL::getInstance()->getConnection();
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function update(int $id, array $params): void
    {
        $params['id'] = $id;
        $sql = "UPDATE {$this->table} SET title=:title, `when`=:when WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($params);
    }

    public function insert(array $params): void
    {
        $placeholdersToParams = $this->prepareParams($params);
        $sql = "INSERT INTO {$this->table} (`title`, `when`, `created_at`) VALUES ({$placeholdersToParams})";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array_values($params));
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE id=?";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    private function prepareParams(array $params): string
    {
        return implode(', ', array_fill(0, count($params), '?'));
    }
}