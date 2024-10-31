<?php
namespace App\Services;
class ViewRendererService
{
    public static function render($view, $data = [])
    {
        extract($data);

        include __DIR__ . '/../views/' . $view . '.php';
    }
}