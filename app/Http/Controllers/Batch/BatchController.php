<?php

namespace App\Http\Controllers\Batch;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\Batch\BatchService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BatchController extends Controller
{
    protected $service;

    public function __construct(BatchService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a list of roles.
     * @date: 02-03-2022
     * @return Application|Factory|View
     */

    public function index()
    {
        $data['batchList'] = $this->service->getAllBatch();
        $data['breadcrumb'] = $this->getBreadcrumb("Batch", "Batch list");
        return view('backend.batches.index', with(['data' => $data]));
    }


    /**
     * Store a newly created permission to role.
     * @date: 02-03-2022
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->storeBatch($request);
        } catch (Exception $ex) {
            return redirect()->route('batches.index')->with('toast_warning', 'Failed, Batch not added!');
        }
        return redirect()->route('batches.index')->with('toast_success', 'Batch added successfully !');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function update(Request $request): RedirectResponse
    {
        try {
            $this->service->updateBatch($request, $_GET['id']);
            return redirect()->route('batches.index')->with('toast_success', 'Batch updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('batches.index')->with('toast_error', 'Error Occured. Batch not updated !');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if ($this->service->deleteBatch($id)) {
                return redirect()->route('batches.index')->with('toast_success', 'Batch deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('batches.index')->with('toast_error', 'Error! Batch is not deleted');
        }

    }

    /**
     * Show the form for editing batch.
     */

    public function batchInfoById()
    {
        $data['result'] = $this->service->getBatchById($_GET['id']);
//        echo json_encode($data);
        return response()->json($data);
    }
}
