<?php
namespace App\Interfaces\Routine;

interface RoutineInterface {
    public function getAllRoutine();
    public function storeRoutine($request);
    public function getRoutineById($id);
}