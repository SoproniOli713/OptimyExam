<?php
namespace App\Interfaces;

use Classes\News;
interface NewsRepositoryInterface
{
    public function listAll();
    public function add(News $news);
    public function delete(int $id);
}