<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{

    /**

     * Display a list of rooms.

     * @date: 13-03-2022
     * @return array of room's list
     */
    public function index(){
        $data['room_list'] = Room::with('unit')->orderBy('id','DESC')->get();
        $data['title']="Room";
        return view('admin_level.rooms.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new room.    
     * @date: 13-03-2022
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit_list = Unit::all();
        return response()->json(['unit' => $unit_list]);
    }

    /**
     * Store a newly created room.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('rooms.index')->with('toast_error', $validator->errors());
        }
        try {
            foreach ($request->room_no as $room) {
                $unit = new Room;
                $unit->unit_id = $request->unit_id;
                $unit->room_no = $room;
                $unit->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('rooms.index')->with('toast_warning', 'Failed, Room not added!');
        }
        return redirect()->route('rooms.index')->with('toast_success', 'Room added successfully !');
    }


    /**
     * Show the form for editing the room.
     * @date: 13-03-2022
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $data['unit'] = Unit::all();
        $data['result'] = Room::with('unit')->find($_GET['id']);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('rooms.index')->with('toast_error', $validator->errors());
        }
        try {
            $room = Room::find($_GET['id']);
            $room->update($request->all());
            return redirect()->route('rooms.index')->with('toast_success', 'Room updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('rooms.index')->with('toast_error', 'Error Occured. Room not updated !');
        }
    }

    /**
     * @date: 13-03-2022
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('rooms.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Room::destroy($id)) {
                return redirect()->route('rooms.index')->with('toast_success', 'Room deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('rooms.index')->with('toast_error', 'Error! Room is not deleted. Dependent data found');
        }
    }

    /** Prepare Validation for room request
     * @date: 13-03-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'unit_id' => 'required',
            'room_no' => 'required',
        ]);
    }
}
