<?php
namespace App\Traits;

use DateTime;
trait CreatedAtTrait
{
    private DateTime $createdAt;

    /**
     * Sets the created date for the entity.
     *
     * @param DateTime|string $createdAt The date as a DateTime object or a formatted date string.
     * @throws \InvalidArgumentException if the provided date is not a valid DateTime or formatted string.
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        if (is_string($createdAt)) {
            // Attempt to create a DateTime from the string
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $createdAt);
            if ($dateTime === false) {
                throw new \InvalidArgumentException('Invalid date format. Expected format: Y-m-d H:i:s');
            }
            $this->createdAt = $dateTime;
        } elseif ($createdAt instanceof DateTime) {
            $this->createdAt = $createdAt;
        } else {
            throw new \InvalidArgumentException('Created At must be a DateTime object or a valid date string.');
        }

        return $this;
    }

    /**
     * Returns the date time of  news/comment was created
     * @return \DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}