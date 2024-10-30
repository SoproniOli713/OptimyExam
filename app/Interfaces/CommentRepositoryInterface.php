<?php
namespace App\Interfaces;
use Classes\Comment;

interface CommentRepositoryInterface
{
    public function listAll();
    public function add(Comment $comment);
    public function deleteById(int $id);
    public function deleteByNewsId(int $id);
}