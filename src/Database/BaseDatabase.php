<?php

declare(strict_types=1);

namespace App\Database;

use App\Contracts\Database;
use App\Enumerations\DatabaseDriver;
use PDO;

abstract class BaseDatabase implements Database
{
    private ?PDO $conn = null;

    public function __construct(
        protected DatabaseDriver $driver,
        protected string $dbname,
        protected int $port,
        protected ?string $host = null,
        protected ?string $user = null,
        protected ?string $passwd = null,
        protected array $options = []
    ) {
        $this->connect();
    }

    public function connect(): void
    {
        $dsn = $this->buildDsn();
        $this->conn = new PDO($dsn, $this->user, $this->passwd, $this->options);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    abstract public function buildDsn(): string;

    public function getConnection(): ?PDO
    {
        return $this->conn;
    }
}