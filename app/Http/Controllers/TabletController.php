<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TabletController extends Controller
{
    /**

     * Display a list of assigned tablet.

     * @date: 15-04-2022
     * @return array of room's list
     */
    public function index(){
        $data['tablet_list'] = Tablet::with('rounder')->orderBy('id','DESC')->get();
        $data['title']="Tablet";
        return view('admin_level.tablets.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new data.    
     * @date: 15-04-2022
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rounder_list = User::where(['role_id'=>2,'status'=>1])->get();
        return response()->json(['rounder' => $rounder_list]);
    }

    /**
     * Store a newly created data.
     * @date: 15-04-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('tablets.index')->with('toast_error', $validator->errors());
        }
        try {
            Tablet::create($request->all());
        } catch (Exception $ex) {
            return redirect()->route('tablets.index')->with('toast_warning', 'Failed, Data not added!');
        }
        return redirect()->route('tablets.index')->with('toast_success', 'Data added successfully !');
    }


    /**
     * Show the form for editing the data.
     * @date: 15-04-2022
     * @param  \App\Models\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tablet $tablet)
    {
        $data['rounder'] = User::where(['role_id'=> 2,'status'=> 1])->get();
        $data['result'] = Tablet::with('rounder')->find($_GET['id']);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @date: 15-04-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('tablets.index')->with('toast_error', $validator->errors());
        }
        try {
            $tablet = Tablet::find($_GET['id']);
            $tablet->update($request->all());
            return redirect()->route('tablets.index')->with('toast_success', 'Data updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('tablets.index')->with('toast_error', 'Error Occured. Data not updated !');
        }
    }

    /**
     * @date: 15-04-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('tablets.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Tablet::destroy($id)) {
                return redirect()->route('tablets.index')->with('toast_success', 'Data deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('tablets.index')->with('toast_error', 'Error! Data is not deleted');
        }
    }

    /** Prepare Validation for room request
     * @date: 15-05-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'rounder_id' => 'required',
            'tablet_name' => 'required',
        ]);
    }
}
