<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:location-list', ['only' => ['index', 'show']]);
        // $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a list of locations.
     * @date: 24-05-2022
     * @return array of location list
     */

    public function index()
    {
        $data['location_list'] = Location::all()->sortByDesc('id');
        $data['title'] = "Location";
        return view('admin_level.locations.index')->with('data', $data);
    }

    /**
     * Store a newly created location.
     * @date: 24-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('locations.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->name as $unit_name) {
                $location = new Location;
                $location->name = $unit_name;
                $location->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('locations.index')->with('toast_warning', 'Failed, Location not added!');
        }
        return redirect()->route('locations.index')->with('toast_success', 'Location added successfully !');
    }


    /**
     * Show the form for editing location.
     * @date: 24-05-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function locationInfoById()
    {
        $data['result'] = Location::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 24-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('locations.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            $location = Location::find($_GET['id']);
            $location->update($request->all());
            return redirect()->route('locations.index')->with('toast_success', 'Location updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('locations.index')->with('toast_error', 'Error Occured. Location not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 24-05-2022
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('locations.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Location::destroy($id)) {
                return redirect()->route('locations.index')->with('toast_success', 'Location deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('locations.index')->with('toast_error', 'Error! Location is not deleted');
        }
    }

    /** Prepare Validation for location request
     * @date: 24-05-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
        ]);
    }
}
