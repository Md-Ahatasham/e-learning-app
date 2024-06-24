<?php

namespace App\Http\Controllers\Routine;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Services\Batch\BatchService;
use App\Services\Course\CourseService;
use App\Services\Routine\RoutineService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    protected $service;

    public function __construct(RoutineService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function index()
    {
        if(Auth::user()->role_id !== 1){
            return $this->getRoutineByUserId(Auth::user()->id);
        }
        return $this->preparedData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->storeRoutine($request->all());
        } catch (Exception $ex) {
            return redirect()->route('routines.index')->with('toast_warning', 'Failed, Routine not added!');
        }
        return redirect()->route('routines.index')->with('toast_success', 'Routine added successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param Routine $routine
     * @return Response
     */
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Routine $routine
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function edit(Routine $routine)
    {
        return $this->preparedData($routine->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Routine $routine
     * @return RedirectResponse
     */
    public function update(Request $request, Routine $routine): RedirectResponse
    {
        try {
            $this->service->updateRoutine($request,$routine->id);
            return redirect()->route('routines.index')->with('toast_success', 'Routine updated successfully');
        } catch (Exception $ex) {
            return redirect()->route('routines.index')->with('toast_error', 'Ops! Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Routine $routine
     * @return RedirectResponse
     */
    public function destroy(Routine $routine): RedirectResponse
    {
        try {
            $this->service->deleteRoutine($routine->id);
            return redirect()->route('routines.index')->with('toast_success', 'Routine deleted successfully');
        } catch (Exception $ex) {
            return redirect()->route('routines.index')->with('toast_error', 'Ops! Something went wrong.');
        }
    }

    /**
     * @param null $id
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function preparedData($id = null)
    {
        $data['routineList'] = $this->service->getAllRoutine();
        $data['courseList'] = app()->make(CourseService::class)->getAllCourse();
        $data['batchList'] = app()->make(BatchService::class)->getAllBatch();
        $data['breadcrumb'] = $this->getBreadcrumb("Routines", "Routine List");
        if(!empty($id)){
            $data['routine'] = $this->service->getRoutineById($id);
        }
        return view('backend.routines.create', with(['data' => $data]));
    }

    public function getRoutineByUserId($userId)
    {
        $data['breadcrumb'] = $this->getBreadcrumb("Routines", "Routine List");
        $data['routineList'] = $this->service->getAllRoutineByUserId($userId);
        return view('backend.routines.index', with(['data' => $data]));
    }
}
