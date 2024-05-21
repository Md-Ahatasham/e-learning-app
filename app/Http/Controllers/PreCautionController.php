<?php

namespace App\Http\Controllers;

use App\Models\PreCaution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreCautionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:precaution-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:precaution-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:precaution-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:precaution-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a list of precautions.
     * @date: 13-03-2022
     * @return array of precaution's list
     */

    public function index()
    {
        $data['precaution_list'] = PreCaution::all()->sortByDesc('id');
        $data['title'] = "PreCaution";
        return view('admin_level.preCautions.index')->with('data', $data);
    }

    /**
     * Show the form for creating precaution.
     * @date: 013-03-2022
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $data['title'] = "PreCaution";
        $data['from'] = $request->from;
        if (empty($request->all())) {
            $data['from'] = 'origin';
        }

        return view('admin_level.preCautions.create')->with('data', $data);
    }

    /**

     * Store a newly created resource in storage.   
     * @date: 13-02-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->prepareValidation($request);
        try {
            PreCaution::create($request->all());
        } catch (Exception $ex) {
            return redirect()->route('precautions.create');
        }
        if ($request->from == 'origin') {
            return redirect()->route('precautions.index')->with('toast_success', 'PreCaution Added Successfully !');
        } elseif ($request->from == 'create') {
            return  redirect()->route('patients.create')->with('toast_success', 'PreCaution Added Successfully !');
        } else {
            return  redirect('patients/' . $request->from . '/edit')->with('toast_success', 'PreCaution added successfully !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *@date: 13-02-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['precaution'] = PreCaution::find($id);
        $data['title'] = "PreCaution";
        return view('admin_level.preCautions.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *@date: 13-02-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreCaution  $preCaution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->prepareValidation($request);
        try {
            $precaution = PreCaution::find($id);
            $precaution->update($request->all());
            return redirect()->route('precautions.index')->with('toast_success', 'PreCaution updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('precautions.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 13-02-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('precautions.index')->with('toast_error', 'Id is not provided !');
        }

        try {
            if (PreCaution::destroy($id)) {
                return redirect()->route('precautions.index')->with('toast_success', 'PreCaution deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('precautions.index')->with('toast_error', 'Error! PreCaution is not deleted.');
        }
    }

    /** Prepare Validation for precaution request
     * @date: 13-02-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        $this->validate($request, [
            'pre_caution_name' => 'required',
            'abbreviation' => 'required',
            'color_code' => 'required',
        ]);
    }
    public function getColorById(){
        $data['result'] = Precaution::find($_GET['id']);
        return response()->json(['result' => $data]);
    }
    
}
