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
        return new News(0, "Default News Title", "Default News Description");
    }
}