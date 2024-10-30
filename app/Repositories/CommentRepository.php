<?php
namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\DatabaseServiceInterface;
use Classes\Comment;


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
            $comment = (new Comment(
                $row['news_id'],
                $row['body'],
                new \DateTime($row['created_at'])
            ))
                ->setId($row['id']);

            $comments[] = $comment;

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