<?php
namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterface;
use Classes\News;
use App\Interfaces\DatabaseServiceInterface;

class NewsRepository implements NewsRepositoryInterface
{
    private $databaseService;
    public function __construct(DatabaseServiceInterface $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    /**
     * List all news
     * @return News[]
     */
    public function listAll()
    {

        $rows = $this->databaseService->select('SELECT * FROM `news`');

        $news = [];

        foreach ($rows as $row) {
            $n = new News();
            $news[] = $n->setId($row['id'])
                ->setTitle($row['title'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at']);
        }
        return $news;
    }

    /**
     * Create a new record in news table
     * @param \Classes\News $news
     * @return mixed
     */
    public function add(News $news)
    {
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(?, ?, ?)";
        $this->databaseService->executeQuery($sql, [$news->getTitle(), $news->getBody(), date('Y-m-d')]);
        return $this->databaseService->lastInsertId();
    }

    /**
     * Deletes a news record in news table
     * @param mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = "DELETE FROM `news` WHERE `id`=" . $id;
        return $this->databaseService->executeQuery($sql);
    }
}