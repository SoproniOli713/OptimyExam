<?php
namespace Classes;
use Classes\Comment;

class CommentFactory
{
    public function createComment(int $newsId, string $body, \DateTime $createdAt): Comment
    {
        return new Comment($newsId, $body, $createdAt);
    }

    public function createDefaultComment(int $newsId): Comment
    {
        return new Comment($newsId, "Default comment content", new \DateTime());
    }

}