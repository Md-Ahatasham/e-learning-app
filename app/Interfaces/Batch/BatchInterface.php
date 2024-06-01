<?php
namespace App\Interfaces\Batch;

interface BatchInterface {
    public function getAllBatch();
    public function storeBatch($request);
    public function getBatchById($id);
}