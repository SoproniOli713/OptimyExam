<?php

namespace Tests\Controllers;

use App\Controllers\NewsController;
use App\Interfaces\NewsRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use Classes\News;
use PHPUnit\Framework\TestCase;

class NewsControllerTest extends TestCase
{
    private $mockNewsRepository;
    private $mockCommentRepository;
    private $newsController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockNewsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->mockCommentRepository = $this->createMock(CommentRepositoryInterface::class);
        $this->newsController = new NewsController($this->mockNewsRepository, $this->mockCommentRepository);
    }

    public function testAddNews()
    {
        // Arrange
        $title = "Test News Title";
        $body = "This is the body of the test news.";

        // Expect the add method to be called once with the correct News object
        $this->mockNewsRepository->expects($this->once())
            ->method('add')
            ->with($this->callback(function ($actualNews) use ($title, $body) {
                return $actualNews->getTitle() === $title &&
                    $actualNews->getBody() === $body &&
                    $actualNews->getId() === null; // Assuming ID should be null
            }))
            ->willReturn(1); // Simulate a successful insert, returning the new ID

        // Act
        $result = $this->newsController->addNews($title, $body);

        // Assert
        $this->assertEquals(1, $result); // Check that the returned ID matches the expected result
    }

    public function testDeleteNewsRemovesNewsAndComments()
    {
        $newsId = 1;

        // Arrange: Set up the comment repository to expect a deleteByNewsId call
        $this->mockCommentRepository->expects($this->once())
            ->method('deleteByNewsId')
            ->with($this->equalTo($newsId));

        // Arrange: Set up the news repository to expect a delete call
        $this->mockNewsRepository->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($newsId))
            ->willReturn(true); // Make sure it returns true

        // Act: Call the deleteNews method
        $result = $this->newsController->deleteNews($newsId);

        // Assert: Check that the result is true
        $this->assertTrue($result); // Now this should pass
    }

}
