<?php
namespace App\Repositories\Batch;

use App\Interfaces\Batch\BatchInterface;
use App\Models\Batch;

class BatchRepository implements BatchInterface{

    public function getAllBatch()
    {
        return Batch::all()->sortByDesc('id');
    }


    public function storeBatch($request)
    {
        Batch::insert($request);
    }

    public function getBatchById($id)
    {
        return Batch::find($id);
    }

    public function updateBatch($request,$id)
    {
        return Batch::find($id)->update($request->all());
    }

    public function deleteBatch($id): int
    {
        return Batch::destroy($id);
    }

}
