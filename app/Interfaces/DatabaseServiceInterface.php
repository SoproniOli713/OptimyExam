<?php
namespace App\Interfaces;

use Number;
interface DatabaseServiceInterface
{
    public function select(string $sqlStatement, array $params = []): array;
    public function executeQuery(string $sqlStatement, array $params = []): int;
    public function lastInsertId(): int;

    public function close();
}