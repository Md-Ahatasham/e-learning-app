<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BehaviorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:behavior-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:behavior-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:behavior-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:behavior-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a list of behaviors.
     * @date: 10-05-2022
     * @return array of behavior list
     */

    public function index()
    {
        $data['behavior_list'] = Behavior::all()->sortByDesc('id');
        $data['title'] = "Behavior";
        return view('admin_level.behaviors.index')->with('data', $data);
    }

    /**
     * Store a newly created behavior.
     * @date: 10-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('behaviors.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->behavior_name as $name) {
                $behavior = new Behavior;
                $behavior->behavior_name = $name;
                $behavior->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('behaviors.index')->with('toast_warning', 'Failed, Behavior not added!');
        }
        return redirect()->route('behaviors.index')->with('toast_success', 'Behavior added successfully !');
    }


    /**
     * Show the form for editing behavior.
     * @date: 10-05-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function behaviorInfoById()
    {
        $data['result'] = Behavior::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 10-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('behaviors.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            Behavior::find($_GET['id'])->update($request->all());
            return redirect()->route('behaviors.index')->with('toast_success', 'Behavior updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('behaviors.index')->with('toast_error', 'Error Occured. Behavior not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 10-05-2022
     * @param  \App\Models\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('behaviors.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Behavior::destroy($id)) {
                return redirect()->route('behaviors.index')->with('toast_success', 'Behavior deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('behaviors.index')->with('toast_error', 'Error! Behavior is not deleted');
        }
    }

    /** Prepare Validation for behavior request
     * @date: 10-05-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'behavior_name' => 'required',
        ]);
    }
}
