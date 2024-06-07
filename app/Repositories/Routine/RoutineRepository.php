<?php
namespace App\Repositories\Routine;

use App\Interfaces\Routine\RoutineInterface;
use App\Models\Routine;

class RoutineRepository implements RoutineInterface{

    public function getAllRoutine()
    {
        return Routine::with(['course', 'batch'])->orderBy('id','DESC')->get();
    }


    public function storeRoutine($request)
    {
        return Routine::create($request);
    }

    public function getRoutineById($id)
    {
        return Routine::find($id);
    }

    public function updateRoutine($request,$id)
    {
        return Routine::find($id)->update($request->all());
    }

    public function deleteRoutine($id): int
    {
        return Routine::destroy($id);
    }

}
