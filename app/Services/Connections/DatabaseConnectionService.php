<?php
namespace App\Services\Connections;

use App\Interfaces\DatabaseConnectionInterface;
use PDO;

/**
 * Class DatabaseConnectionService
 *
 * This class provides the implementation of the DatabaseConnectionInterface
 * and manages the connection to the database.
 */
class DatabaseConnectionService implements DatabaseConnectionInterface
{
    private $username;
    private $password;
    private $port;
    private $host;
    private $database;
    private $connection;
    public function __construct(array $config)
    {
        $this->username = $config['username'];

        $this->password = $config['password'];

        $this->port = $config['port'];

        $this->host = $config['host'];

        $this->database = $config['database'];

        try {

            $domain = "mysql:dbname={$this->database};host={$this->host};port={$this->port}";

            $this->connection = new PDO($domain, $this->username, $this->password);
            // Set PDO to throw exceptions for errors
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\Throwable $th) {
            error_log("Cannot connect to database {$th->getMessage()}");
            throw new \Exception($th->getMessage());
        }

    }
    public function getConnection()
    {
        return $this->connection;
    }
}