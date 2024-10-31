<?php
namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\DatabaseServiceInterface;
use Classes\Comment;


/**
 * Class CommentRepository
 *
 * This class implements the CommentRepositoryInterface, providing methods for 
 * interacting with the `comment` table in the database. It includes operations 
 * such as listing, adding, and deleting news records.
 */
class CommentRepository implements CommentRepositoryInterface
{
    private $databaseService;
    public function __construct(DatabaseServiceInterface $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    /**
     * Get all comments in the comment table
     * @return Comment[]
     */
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

    /**
     * Add a new record on the comment table
     * @param \Classes\Comment $comment
     * @return int
     */
    public function add(Comment $comment)
    {

        # NOTE :: created_at will use latest datetime upon calling this function

        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES (?, ?, ?)";

        $this->databaseService->executeQuery($sql, [
            $comment->getBody(),
            date('Y-m-d H:i:s'),
            $comment->getNewsId()
        ]);

        return $this->databaseService->lastInsertId();
    }

    /**
     * Delete a record on comment table using comment.id key
     * @param int $id the comment id in the comment table
     * @return bool
     */
    public function deleteById(int $id)
    {
        $sql = "DELETE FROM `comment` WHERE `id` = ?";

        return $this->databaseService->executeQuery($sql, [$id]) > 0;
    }

    /**
     * Delete a records in comment table using comment.news_id
     * @param mixed $id related news_id of the comment
     * @return bool
     */
    public function deleteByNewsId($id)
    {
        $sql = "DELETE FROM `comment` WHERE `news_id` = ?";

        // Return true if comments were deleted
        return $this->databaseService->executeQuery($sql, [$id]) > 0;
    }

}