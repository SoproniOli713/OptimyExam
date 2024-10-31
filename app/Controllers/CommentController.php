<?php
namespace App\Controllers;
use App\Interfaces\CommentRepositoryInterface;
use Classes\Comment;


/**
 * Class CommentController
 *
 * This controller manages actions related to comments, including listing, adding, 
 * and deleting comments associated with news articles. It interacts with a 
 * CommentRepository to perform database operations on the `comment` table.
 */
class CommentController
{
	private $commentRepository;
	private static $instance = null;

	public function __construct(CommentRepositoryInterface $commentRepositoryInterface)
	{

		$this->commentRepository = $commentRepositoryInterface;
	}
	/**
	 * Create a new instance of the class if it doesn't already exist.
	 * This implements the Singleton pattern, ensuring only one instance of the class.
	 *
	 * @param \App\Interfaces\CommentRepositoryInterface $commentRepositoryInterface
	 *        An instance of the CommentRepositoryInterface to manage comment data.
	 * @return object
	 *         The singleton instance of this class.
	 * TODO :: for foture, if application becomes big, you may use Dependency Inversion Pattern
	 * as to it will be more advantagous for testing and flexibility 
	 */
	public static function getInstance(CommentRepositoryInterface $commentRepositoryInterface)
	{
		if (null === self::$instance) {

			self::$instance = new self($commentRepositoryInterface);

		}

		return self::$instance;
	}
	/**
	 * list all comments
	 * @return mixed
	 */
	public function listComments()
	{
		try {

			return $this->commentRepository->listAll();

		} catch (\Throwable $th) {
			// TODO :: Return a custom message you want here.
		}

	}
	/**
	 * Add a new comment record for an news article
	 * @param string $body news article comment context
	 * @param mixed $newsId news id
	 * @return mixed
	 */
	public function addCommentForNews(string $body, int $newsId)
	{
		try {
			$comment = new Comment($newsId, $body);

			return $this->commentRepository->add($comment);

		} catch (\Throwable $th) {
			// TODO :: Return a custom message you want here.
		}

	}
	/**
	 * Delete a comment by its id
	 * @param int $id
	 * @return mixed
	 */
	public function deleteComment(int $id)
	{
		try {

			return $this->commentRepository->deleteById($id);

		} catch (\Throwable $th) {
			// TODO :: Return a custom message you want here.
			throw $th;
		}

	}
}