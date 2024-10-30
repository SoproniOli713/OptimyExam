<?php
namespace App\Controllers;
use App\Interfaces\NewsRepositoryInterface;

use App\Controllers\CommentController;
use App\Controllers\DB;
use Classes\News;

class NewsController
{
	private static $instance = null;
	private $newsRepository;

	private function __construct(NewsRepositoryInterface $NewsRepository)
	{

		$this->newsRepository = $NewsRepository;

	}

	public static function getInstance(NewsRepositoryInterface $newsRepositoryInterface)
	{
		if (null === self::$instance) {
			self::$instance = new self($newsRepositoryInterface);
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

		// TODO:: add comment deletion base on news_id {$id}

		return $this->newsRepository->delete($id);


	}
}