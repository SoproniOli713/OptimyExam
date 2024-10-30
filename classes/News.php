<?php
namespace Classes;
use App\Traits\CreatedAtTrait;
use DateTime;
class News
{
	use CreatedAtTrait;
	private ?int $id = null;
	private string $title;
	private string $body;


	public function __construct(int $id, string $title, string $body, DateTime $createdAt = null)
	{
		$this->id = $id;

		$this->title = $title;

		$this->body = $body;

		$this->setCreatedAt($createdAt);

	}

	/**
	 * Sets the News ID.
	 * @param int|null $id The ID of the comment, or null if not set.
	 * @return $this
	 */
	public function setId(int $id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Returns the News ID
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Sets the title of the news.
	 *
	 * @param string $title The title of the news.
	 * @throws \InvalidArgumentException if the title is empty.
	 * @return $this
	 */
	public function setTitle(string $title)
	{
		if (empty($title)) {
			throw new \InvalidArgumentException("News title cannot be empty");
		}
		$this->title = $title;

		return $this;
	}

	/**
	 * Returns the News title
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/**
	 * Sets the body or description of the news.
	 *
	 * @param string $body The content of the news.
	 * @throws \InvalidArgumentException if the body is empty.
	 * @return $this
	 */
	public function setBody(string $body)
	{

		if (empty($body)) {
			throw new \InvalidArgumentException("News body cannot be empty");
		}

		$this->body = $body;

		return $this;
	}

	/**
	 * Returns the News description/body/content
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

}