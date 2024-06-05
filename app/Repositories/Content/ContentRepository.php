<?php
namespace App\Repositories\Content;

use App\Interfaces\Content\ContentInterface;
use App\Models\Content;

class ContentRepository implements ContentInterface{

    public function getAllContent()
    {
        return Content::all()->sortByDesc('id');
    }


    public function storeContent($request)
    {
        return Content::create($request);
    }

    public function getContentById($id)
    {
        return Content::where('course_id',$id)->get();
    }

    public function updateContent($request,$id)
    {
        return Content::find($id)->update($request->all());
    }

    public function deleteContent($id): int
    {
        return Content::destroy($id);
    }

}
