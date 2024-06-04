<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialtyController extends Controller
{
    /**
     * Display a list of specialty.
     * @date: 13-03-2022
     * @return array of specialty list
     */

    public function index()
    {
        $data['specialty_list'] = Specialty::all()->sortByDesc('id');
        $data['title'] = "Specialty";
        return view('backend.specialties.index')->with('data', $data);
    }

    /**
     * Store a newly created specialty.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('specialties.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->specialty_name as $specialty) {
                $unit = new Specialty;
                $unit->specialty_name = $specialty;
                $unit->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('specialties.index')->with('toast_warning', 'Failed, Specialty not added!');
        }
        return redirect()->route('specialties.index')->with('toast_success', 'Specialty added successfully !');
    }


    /**
     * Show the form for editing specialty.
     * @date: 13-03-2022
     * @param  Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        $data['result'] = Specialty::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('specialties.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            $specialty = Specialty::find($_GET['id']);
            $specialty->update($request->all());
            return redirect()->route('specialties.index')->with('toast_success', 'Specialty updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('specialties.index')->with('toast_error', 'Error Occured. Specialty not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 13-03-2022
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('specialties.index')->with('toast_error', 'Id is not provided !');
        }
        try {
            if (Specialty::destroy($id)) {
                return redirect()->route('specialties.index')->with('toast_success', 'Specialty deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('specialties.index')->with('toast_error', 'Error! Specialty is not deleted');
        }
    }

    /** Prepare Validation for unit request
     * @date: 13-03-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'specialty_name' => 'required',
        ]);
    }
}
