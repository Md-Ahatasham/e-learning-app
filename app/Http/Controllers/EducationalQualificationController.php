<?php

namespace App\Http\Controllers;

use App\Models\EducationalQualification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationalQualificationController extends Controller
{
    /**
     * Display a list of Educational Qualification.
     * @date: 13-03-2022
     * @return array of Educational Qualification list 
     */

    public function index()
    {
        $data['degree_list'] = EducationalQualification::all()->sortByDesc('id');
        $data['title'] = "Qualification";
        return view('backend.educationalDegrees.index')->with('data', $data);
    }

    /**
     * Store a newly created qualification.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('qualifications.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            foreach ($request->degree_name as $degree) {
                $unit = new EducationalQualification;
                $unit->degree_name = $degree;
                $unit->save();
            }
        } catch (Exception $ex) {
            return redirect()->route('qualifications.index')->with('toast_warning', 'Failed, EducationalQualification not added!');
        }
        return redirect()->route('qualifications.index')->with('toast_success', 'EducationalQualification added successfully !');
    }


    /**
     * Show the form for editing educationalQualification.    
     * @date: 13-03-2022
     * @param  EducationalQualification $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalQualification $educationalQualification)
    {
        $data['result'] = EducationalQualification::find($_GET['id']);
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     * @date: 13-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->prepareValidation($request);
        if ($validator->fails()) {
            return redirect()->route('qualifications.index')->with('toast_error', $validator->errors()->first());
        }
        try {
            $ducationalQualification = EducationalQualification::find($_GET['id']);
            $ducationalQualification->update($request->all());
            return redirect()->route('qualifications.index')->with('toast_success', 'EducationalQualification updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('qualifications.index')->with('toast_error', 'Error Occured. EducationalQualification not updated !');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 13-03-2022
     * @param  \App\Models\EducationalQualification  $educationalQualification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return redirect()->route('qualifications.index')->with('toast_error', 'Id is not provided !');
        }
        try {
            if (EducationalQualification::destroy($id)) {
                return redirect()->route('qualifications.index')->with('toast_success', 'EducationalQualification deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('qualifications.index')->with('toast_error', 'Error! EducationalQualification is not deleted');
        }
    }

    /** Prepare Validation for qualification request
     * @date: 13-03-2022
     * @return validation
     */
    public function prepareValidation($request)
    {
        return Validator::make($request->all(), [
            'degree_name' => 'required',
        ]);
    }
}
