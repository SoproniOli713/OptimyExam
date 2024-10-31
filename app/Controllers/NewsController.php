<?php
namespace App\Controllers;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\NewsRepositoryInterface;
use Classes\News;
use App\Services\ViewRendererService;

/**
 * Class NewsController
 *
 * This controller manages actions related to news articles, including listing, 
 * adding, and deleting news entries. It interacts with a NewsRepository to handle 
 * database operations on the `news` table and a CommentRepository to manage comments 
 * associated with each news entry.
 *
 * Responsibilities:
 * - Display news articles with their comments.
 * - Add new news articles.
 * - Delete a news article and any associated comments.
 */
class NewsController
{
	private static $instance = null;
	private $newsRepository;
	private $commentRepository;

	public function __construct(NewsRepositoryInterface $NewsRepository, CommentRepositoryInterface $commentRepositoryInterface)
	{

		$this->newsRepository = $NewsRepository;
		$this->commentRepository = $commentRepositoryInterface;

	}

	/**
	 * Creates or retrieves the single instance of the class.
	 *
	 * This method checks if an instance of the class has already been created.
	 * If not, it instantiates the class with the provided dependencies.
	 * This is a typical Singleton pattern implementation.
	 *
	 * @param NewsRepositoryInterface $newsRepositoryInterface The repository used for news-related data operations.
	 * @param CommentRepositoryInterface $commentRepositoryInterface The repository used for comment-related data operations.
	 * @return self The single instance of this class.
	 * 
	 * TODO :: for foture, if application becomes big, you may use Dependency Inversion Pattern
	 * as to it will be more advantagous for testing and flexibility 
	 */
	public static function getInstance(NewsRepositoryInterface $newsRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface)
	{
		if (null === self::$instance) {
			self::$instance = new self($newsRepositoryInterface, $commentRepositoryInterface);
			;
		}
		return self::$instance;
	}

	/**
	 * Display list of news articles with comments
	 * use for browser
	 * @return void
	 */
	public function displayNewsWithComments()
	{
		try {
			$newsList = $this->listNews();
			$commentsList = $this->commentRepository->listAll();

			ViewRendererService::render('news', compact('newsList', 'commentsList'));

		} catch (\Throwable $th) {
			//throw $th;
			// TODO :: Return a custom message you want here.

		}

	}

	/**
	 * list all news
	 */
	public function listNews()
	{
		try {
			return $this->newsRepository->listAll();
		} catch (\Throwable $th) {
			//throw $th;
			// TODO :: Return a custom message you want here.
		}

	}

	/**
	 * add a record in news table
	 */
	public function addNews($title, $body)
	{
		try {
			$news = new News(null, $title, $body, new \DateTime());
			$news->setTitle($title)->setBody($body);
			return $this->newsRepository->add($news);
		} catch (\Throwable $th) {
			//throw $th;
			// TODO :: Return a custom message you want here.
		}

	}

	/**
	 * deletes a news, and also linked comments
	 */
	public function deleteNews($id)
	{

		try {
			// delete the comments associated to this news
			$this->commentRepository->deleteByNewsId($id);

			return $this->newsRepository->delete($id);
		} catch (\Throwable $th) {
			//throw $th;
			// TODO :: Return a custom message you want here.
		}

	}

	/**
	 * Get the list of news with its comments
	 * @return 
	 */
	public function getNewsWithComments()
	{
		try {

			// TODO :: if the data becomes so big, then we need to make
			// adjustment on how to fetch the comments to have limits or specify
			// what list of comments to get

			$newsList = $this->listNews();
			$commentsList = $this->commentRepository->listAll();

			$dataList = [];

			foreach ($newsList as $key => $news) {

				$news_data = array(
					'newsTitle' => $news->getTitle(),
					'newsDescription' => $news->getBody(),
					'comments' => []
				);

				foreach ($commentsList as $key => $comment) {
					if ($comment->getNewsId() == $news->getId()) {
						$news_data['comments'][] = [
							'id' => $comment->getId(),
							'message' => $comment->getBody()
						];
					}
				}
				$dataList[] = $news_data;

			}

			return json_encode($dataList);

		} catch (\Throwable $th) {
			//throw $th;
			// TODO :: Return a custom message you want here.

		}
	}
}