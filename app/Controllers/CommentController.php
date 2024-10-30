<?php
namespace App\Controllers;
use App\Interfaces\CommentRepositoryInterface;
use Classes\Comment;

class CommentController
{
	private $commentRepository;
	private static $instance = null;

	private function __construct(CommentRepositoryInterface $commentRepositoryInterface)
	{

		$this->commentRepository = $commentRepositoryInterface;
	}

	public static function getInstance(CommentRepositoryInterface $commentRepositoryInterface)
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new self($commentRepositoryInterface);
		}
		return self::$instance;
	}

	public function listComments()
	{
		return $this->commentRepository->listAll();
	}

	public function addCommentForNews($body, $newsId)
	{
		$comment = new Comment();
		$comment->setBody($body)
			->setNewsId($newsId);
		return $this->commentRepository->add($comment);
	}

	public function deleteComment($id)
	{
		return $this->commentRepository->deleteById($id);
	}
}