<?php
namespace Classes;

use Classes\News;

class NewsFactory
{
    public function createNews(int $id, string $title, string $body, \DateTime $createdAt = null): News
    {
        return new News($id, $title, $body, $createdAt);
    }

    public function createDefaultNews()
    {
        return new News(null, "News title", "This is the body of the new test news.", new \DateTime());
    }
}