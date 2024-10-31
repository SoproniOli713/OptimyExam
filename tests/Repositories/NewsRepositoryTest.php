<?php

namespace Tests\Repositories;

use App\Repositories\NewsRepository;
use App\Interfaces\DatabaseServiceInterface;
use Classes\News;
use Classes\NewsFactory;
use PHPUnit\Framework\TestCase;

class NewsRepositoryTest extends TestCase
{
    private $databaseServiceMock;
    private $newsRepository;

    protected function setUp(): void
    {
        // Create a mock for the DatabaseServiceInterface
        $this->databaseServiceMock = $this->createMock(DatabaseServiceInterface::class);
        $this->newsRepository = new NewsRepository($this->databaseServiceMock);
    }

    public function testListAllReturnsNewsArray()
    {
        // Arrange: Set up the database mock to return fake data
        $this->databaseServiceMock->method('select')->willReturn([
            ['id' => 1, 'title' => 'Test News 1', 'body' => 'Body of test news 1', 'created_at' => '2024-10-30 12:00:00'],
            ['id' => 2, 'title' => 'Test News 2', 'body' => 'Body of test news 2', 'created_at' => '2024-10-30 12:00:00'],
        ]);

        // Act: Call the listAll method
        $result = $this->newsRepository->listAll();

        // Assert: Check that the result is an array and contains News objects
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(News::class, $result[0]);
        $this->assertEquals('Test News 1', $result[0]->getTitle());
    }

    public function testAddInsertsNewsIntoDatabase()
    {
        // Arrange: Create a News object
        $news = (new NewsFactory())->createDefaultNews();
        $createdAt = date('Y-m-d H:i:s');

        // Set up the database mock to expect the executeQuery method
        $this->databaseServiceMock->expects($this->once())
            ->method('executeQuery')
            ->with(
                $this->equalTo("INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(?, ?, ?)"),
                $this->equalTo([$news->getTitle(), $news->getBody(), $createdAt])
            );

        // Mock the lastInsertId to return a specific ID
        $this->databaseServiceMock->method('lastInsertId')->willReturn(1);

        // Act: Call the add method
        $insertedId = $this->newsRepository->add($news);

        // Assert: Check that the inserted ID is correct
        $this->assertEquals(1, $insertedId);
    }

    public function testDeleteRemovesNewsFromDatabase()
    {
        // Arrange: Set up the database mock to expect the executeQuery method
        $this->databaseServiceMock->expects($this->once())
            ->method('executeQuery')
            ->with(
                $this->equalTo("DELETE FROM `news` WHERE `id` = ?"),
                $this->equalTo([1]) // Ensure the parameter array is set correctly
            )
            ->willReturn(1); // Simulate that one row was deleted

        // Act: Call the delete method
        $result = $this->newsRepository->delete(1);

        // Assert: Check that the result indicates success
        $this->assertTrue($result); // Ensure the result indicates success
    }


}
