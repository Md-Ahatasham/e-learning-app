<?php
namespace App\Services\Content;

use App\Http\Controllers\Controller;
use App\Repositories\Content\ContentRepository;
use Illuminate\Support\Facades\Hash;

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
        $response = [];
        try {
            if($request->hasFile('contents')){
                $files = $request->file('contents');
                foreach($files as $file){
                    $contentRequest = $this->prepareContentRequest($request,$file);
                    $response[] = $this->repository->storeContent($contentRequest);
                }
            }
            return $response;
        } catch (\Exception $ex){
            return $ex->getMessage();
        }
    }

    public function updateContent($request, $id)
    {
        return $this->repository->updateContent($request,$id);
    }

    public function deleteContent($id): int
    {
        return $this->repository->deleteContent($id);
    }

    public function prepareContentRequest($request, $file): array
    {
        $preparedRequest = [];
        $preparedRequest['course_id'] = $request['course_id'] ?? 999;
        $preparedRequest['content_title'] = $request['content_title'] ?? 'title';
        $preparedRequest['content_sub_title'] = $request['content_sub_title'] ?? 'subtitle';
        $preparedRequest['content_path'] = $this->uploadContent($request,$file);
        return $preparedRequest;
    }

    public function getContent($id)
    {
        return $this->repository->getContentById($id);
    }

}
