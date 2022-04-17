<?php

declare(strict_types=1);

namespace App\Database;

use App\Enumerations\DatabaseDriver;
use PDO;

class MySQL extends BaseDatabase
{
    private static ?self $instance = null;

    private function __construct()
    {
        $driver = DatabaseDriver::MYSQL;
        $database = getenv('DB_DATABASE');
        $port = (int) getenv('DB_PORT');
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];

        parent::__construct($driver, $database, $port, $host, $user, $pass, $options);
    }

    private function __clone(): void {}

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function buildDsn(): string
    {
        return "{$this->driver->value}:dbname={$this->dbname};host={$this->host};port={$this->port}";
    }
}