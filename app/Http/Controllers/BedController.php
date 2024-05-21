<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BedController extends Controller
{
    /**
     * Display a list of beds.
     * @date: 13-03-2022
     * @return array of bes's list
     */

    public function index()
    {
        $data['bed_list'] = Bed::with('room')->orderBy('id','DESC')->get();
        $data['title'] = "Bed";
        return view('admin_level.beds.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new bed.
     * @date: 13-03-2022
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_list = Room::all();
        return response()->json(['room' => $room_list], 200);
    }

    /**
     * Store a newly created bed.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('beds.index')->with('toast_error', $validator->errors());
        }
        try {
            foreach ($request->bed_no as $bed) {
                $unit = new Bed;
                $unit->room_id = $request->room_id;
                $unit->bed_no = $bed;
                $unit->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('beds.index')->with('toast_warning', 'Failed, Bed not added!');
        }
        return redirect()->route('beds.index')->with('toast_success', 'Bed added successfully !');
    }



    /**
     * Show the form for editing the specified bed.
     * @date: 13-03-2022
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Bed $bed)
    {
        $data['room'] = Room::all();
        $data['result'] = Bed::with('room')->find($_GET['id']);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('beds.index')->with('toast_error', $validator->errors());
        }
        try {
            $bed = Bed::find($_GET['id']);
            $bed->update($request->all());
            return redirect()->route('beds.index')->with('toast_success', 'Bed updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('beds.index')->with('toast_error', 'Error Occured. Bed not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 13-03-2022
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('beds.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Bed::destroy($id)) {
                return redirect()->route('beds.index')->with('toast_success', 'Bed deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('beds.index')->with('toast_error', 'Error! Bed is not deleted. Dependent data found');
        }
    }

    /** Prepare Validation for bed request
     * @date :13-02-2-22
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'room_id' => 'required',
            'bed_no' => 'required',
        ]);
    }
}
