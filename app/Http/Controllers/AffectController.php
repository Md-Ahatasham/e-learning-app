<?php

namespace App\Http\Controllers;

use App\Models\Affect;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AffectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:affect-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:affect-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:affect-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:affect-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a list of affects.
     * @date: 10-05-2022
     * @return array of affect list
     */

    public function index()
    {
        $data['affect_list'] = Affect::all()->sortByDesc('id');
        $data['title'] = "Affect";
        return view('admin_level.affects.index')->with('data', $data);
    }

    /**
     * Store a newly created affect.
     * @date: 10-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('affects.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->affect_name as $name) {
                $affect = new Affect;
                $affect->affect_name = $name;
                $affect->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('affects.index')->with('toast_warning', 'Failed, Affect not added!');
        }
        return redirect()->route('affects.index')->with('toast_success', 'Affect added successfully !');
    }


    /**
     * Show the form for editing affect.
     * @date: 10-05-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function affectInfoById()
    {
        $data['result'] = Affect::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 10-05-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Affect  $affect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('affects.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            Affect::find($_GET['id'])->update($request->all());
            return redirect()->route('affects.index')->with('toast_success', 'Affect updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('affects.index')->with('toast_error', 'Error Occured. Affect not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 10-05-2022
     * @param  \App\Models\Affects  $affect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('affects.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (Affect::destroy($id)) {
                return redirect()->route('affects.index')->with('toast_success', 'Affect deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('affects.index')->with('toast_error', 'Error! Affect is not deleted');
        }
    }

    /** Prepare Validation for affect request
     * @date: 10-05-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'affect_name' => 'required',
        ]);
    }
}
