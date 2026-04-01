<?php

namespace App\Services;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class PdoConnection
{
    private PDO $pdo;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->safeLoad();

        $host = $_ENV['DB_HOST'] ?? config('database.connections.mysql.host');
        $port = $_ENV['DB_PORT'] ?? config('database.connections.mysql.port');
        $database = $_ENV['DB_DATABASE'] ?? config('database.connections.mysql.database');
        $username = $_ENV['DB_USERNAME'] ?? config('database.connections.mysql.username');
        $password = $_ENV['DB_PASSWORD'] ?? config('database.connections.mysql.password');

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            logger()->error('Erro de conexão PDO: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
