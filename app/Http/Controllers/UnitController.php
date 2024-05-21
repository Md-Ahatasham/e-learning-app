<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:location-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a list of units.
     * @date: 08-03-2022
     * @return array of unit list
     */

    public function index()
    {
        $data['unit_list'] = Unit::all()->sortByDesc('id');
        $data['title'] = "Unit";
        return view('admin_level.units.index')->with('data', $data);
    }

    /**
     * Store a newly created unit.
     * @date: 08-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('units.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->name as $unit_name) {
                $unit = new Unit;
                $unit->name = $unit_name;
                $unit->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('units.index')->with('toast_warning', 'Failed, Location not added!');
        }
        return redirect()->route('units.index')->with('toast_success', 'Location added successfully !');
    }


    /**
     * Show the form for editing unit.
     * @date: 08-03-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function unitInfoById()
    {
        $data['result'] = Unit::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 08-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('units.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            $unit = Unit::find($_GET['id']);
            $unit->update($request->all());
            return redirect()->route('units.index')->with('toast_success', 'Location updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('units.index')->with('toast_error', 'Error Occured. Location not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 08-03-2022
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('units.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Unit::destroy($id)) {
                return redirect()->route('units.index')->with('toast_success', 'Location deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('units.index')->with('toast_error', 'Error! Location is not deleted');
        }
    }

    /** Prepare Validation for unit request
     * @date: 08-03-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
        ]);
    }
}
