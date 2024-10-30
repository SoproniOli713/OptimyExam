<?php
namespace Classes;

use App\Traits\CreatedAtTrait;
class Comment
{
	use CreatedAtTrait;
	private ?int $id = null;
	private string $body;
	private int $newsId;


	public function __construct(int $newsId, string $body, \DateTime $createdAt = null)
	{
		$this->newsId = $newsId;
		$this->body = $body;
		$this->setCreatedAt($createdAt);
	}

	/**
	 * Sets the comment ID.
	 *
	 * @param int|null $id The ID of the comment, or null if not set.
	 * @return $this
	 */
	public function setId(?int $id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Returns the comment ID
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * Sets the comment body.
	 *
	 * @param string $body The content of the comment.
	 * @throws \InvalidArgumentException if the body is empty.
	 * @return $this
	 */
	public function setBody($body)
	{
		if (empty($body)) {
			throw new \InvalidArgumentException("Comment body cannot be empty");
		}
		$this->body = $body;

		return $this;
	}

	/**
	 * Returns comment body
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Returns comment News ID
	 * @return int
	 */
	public function getNewsId()
	{
		return $this->newsId;
	}
	/**
	 * Sets News ID of the comment
	 * @param int $newsId The ID of the news item; must be a positive integer.
	 * @throws \InvalidArgumentException if the News ID is not a positive integer.
	 * @return $this
	 */
	public function setNewsId($newsId)
	{

		// Check if $newsId is a positive integer
		if (!is_int($newsId) || $newsId <= 0) {
			throw new \InvalidArgumentException('News ID must be a positive integer.');
		}

		$this->newsId = $newsId;

		return $this;
	}
}