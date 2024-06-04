<?php
namespace App\Services\Content;

use App\Http\Controllers\Controller;
use App\Repositories\Content\ContentRepository;

class ContentService extends Controller {
    protected $repository;

    public function __construct(ContentRepository $repository){
        $this->repository = $repository;
    }

    public function getAllContent()
    {
        return $this->repository->getAllContent();
    }

    public function getContentById($id)
    {
        return $this->repository->getContentById($id);
    }


    public function storeContent($request)
    {
        return $this->repository->storeContent($request);
    }

    public function updateContent($request, $id)
    {
        return $this->repository->updateContent($request,$id);
    }

    public function deleteContent($id): int
    {
        return $this->repository->deleteContent($id);
    }


}
