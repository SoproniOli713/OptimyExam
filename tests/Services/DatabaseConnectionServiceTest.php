<?php

namespace Tests\Services\Connections;

use App\Services\Connections\DatabaseConnectionService;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionServiceTest extends TestCase
{
    private $config;

    protected function setUp(): void
    {
        // Sample configuration for database connection
        $this->config = [
            'username' => 'root',
            'password' => '',
            'port' => '3306',
            'host' => 'localhost',
            'database' => 'phptest',
        ];
    }

    public function testSuccessfulConnection()
    {
        // Create the DatabaseConnectionService instance with valid config
        $databaseService = new DatabaseConnectionService($this->config);

        // Assert that getConnection() returns a PDO instance
        $this->assertInstanceOf(PDO::class, $databaseService->getConnection());
    }

    public function testConnectionFailureThrowsException()
    {
        // Simulate an invalid configuration (wrong port)
        $this->config['port'] = '9999';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('SQLSTATE');  // Exception message indicating connection failure

        // Attempt to create a DatabaseConnectionService instance
        new DatabaseConnectionService($this->config);
    }
}
