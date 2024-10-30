<?php
namespace App\Services;

use App\Interfaces\DatabaseConnectionInterface;
use App\Interfaces\DatabaseServiceInterface;
use PDO;
class DatabaseService implements DatabaseServiceInterface
{

    private $dbService;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->dbService = $databaseConnection->getConnection();
    }

    /**
     * Runs a select query on the database
     * @param mixed $sql
     * @return array
     */
    public function select(string $query, array $params = []): array
    {
        $statement = $this->dbService->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Runs insert, update, delete query on the database
     * @param string $sql
     * @return int
     */
    public function executeQuery(string $query, array $params = []): int
    {
        $statement = $this->dbService->prepare($query);
        return $statement->execute($params);
        // return $statement->rowCount();
    }

    /**
     * Get the last inserted Id
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->dbService->lastInsertId();
    }

    /**
     * Closes the database connection
     * @return mixed
     */
    public function close()
    {
        return $this->dbService->close();
    }
}