<?php
namespace App\Interfaces\Content;

interface ContentInterface {
    public function getAllContent();
    public function storeContent($request);
    public function getContentById($id);
}