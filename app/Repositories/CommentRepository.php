<?php
namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\DatabaseServiceInterface;
use Classes\Comment;
use App\Controllers\DB;

class CommentRepository implements CommentRepositoryInterface
{
    private $databaseService;
    public function __construct(DatabaseServiceInterface $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function listAll()
    {

        $rows = $this->databaseService->select('SELECT * FROM `comment`');

        $comments = [];
        foreach ($rows as $row) {
            $n = new Comment();
            $comments[] = $n->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at'])
                ->setNewsId($row['news_id']);
        }

        return $comments;
    }

    public function add(Comment $comment)
    {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES (?, ?, ?)";
        $this->databaseService->executeQuery($sql, [
            $comment->getBody(),
            date('Y-m-d'),
            $comment->getNewsId()
        ]);

        return $this->databaseService->lastInsertId();
    }

    public function deleteById(int $id)
    {
        $sql = "DELETE FROM `comment` WHERE `id` = ?";
        return $this->databaseService->executeQuery($sql, [$id]) > 0;
    }

    public function deleteByNewsId(int $id)
    {
        $sql = "DELETE FROM `comment` WHERE `news_id` = ?";
        return $this->databaseService->executeQuery($sql, [$id]) > 0;
    }
}