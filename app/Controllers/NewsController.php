<?php
namespace App\Controllers;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\NewsRepositoryInterface;
use Classes\News;

class NewsController
{
	private static $instance = null;
	private $newsRepository;
	private $commentRepository;

	private function __construct(NewsRepositoryInterface $NewsRepository, CommentRepositoryInterface $commentRepositoryInterface)
	{

		$this->newsRepository = $NewsRepository;
		$this->commentRepository = $commentRepositoryInterface;

	}

	public static function getInstance(NewsRepositoryInterface $newsRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface)
	{
		if (null === self::$instance) {
			self::$instance = new self($newsRepositoryInterface, $commentRepositoryInterface);
			;
		}
		return self::$instance;
	}

	/**
	 * list all news
	 */
	public function listNews()
	{
		return $this->newsRepository->listAll();

	}

	/**
	 * add a record in news table
	 */
	public function addNews($title, $body)
	{

		$news = new News;
		$news->setTitle($title)->setBody($body);
		return $this->newsRepository->add($news);
	}

	/**
	 * deletes a news, and also linked comments
	 */
	public function deleteNews($id)
	{

		// delete the comments associated to this news
		$this->commentRepository->deleteByNewsId($id);
		return $this->newsRepository->delete($id);


	}
}