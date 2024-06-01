<?php
namespace App\Services\Batch;

use App\Http\Controllers\Controller;
use App\Repositories\Batch\BatchRepository;

class BatchService extends Controller {
    protected $repository;

    public function __construct(BatchRepository $repository){
        $this->repository = $repository;
    }

    public function getAllBatch()
    {
        return $this->repository->getAllBatch();
    }

    public function getBatchById($id)
    {
        return $this->repository->getBatchById($id);
    }

    /**
     * @param $request
     * @return null
     */
    public function storeBatch($request)
    {
        $prepareData = [];
        foreach ($request->batch_name as $name) {
            $prepareData[] = ['batch_name' => $name];
        }
        return $this->repository->storeBatch($prepareData);
    }

    public function updateBatch($request, $id)
    {
        return $this->repository->updateBatch($request,$id);
    }

    public function deleteBatch($id)
    {
        return $this->repository->deleteBatch($id);
    }


}
