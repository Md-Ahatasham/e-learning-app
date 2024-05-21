<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientInOutHistory;
use App\Models\PatientPreCaution;
use App\Models\PreCaution;
use Exception;
use Illuminate\Http\Request;

class PatientPrecautionController extends Controller
{
    public $patient;

    /**
     * access patient controller to access save patient wise precaution method.
     * @date: 01-04-2022
     * @return null
     */

    public function __construct(PatientController $patient)
    {
        $this->patient = $patient;
    }


    /**
     * Show the form for editing the specified resource.
     * @date: 01-04-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['patient'] = Patient::find($id);
        $data['patient_discharged_date'] = PatientInOutHistory::OrderBy('id','DESC')->where('patient_id',$id)->first();
        $data['precaution_list'] = PreCaution::all();
        $data['patientPrecaution'] = PatientPreCaution::with(['precaution'])->where('patient_id', $id)->get();
        foreach ($data['patient']['precaution'] as $row) {
            $data['patient_precaution'][$row->pre_caution_id] = $row['pre_caution_id'];
        }
        $data['title'] = "Patient Precaution";
        return view('admin_level.patientPrecautions.edit', with(['data' => $data]));
    }

    /**
     * Update the specified resource in storage.
     * @date: 01-04-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientPrecaution  $patient_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->patient->precautionForPatient($id, $request->precaution, 1);
            return redirect()->route('patients.show', $id)->with('toast_success', 'Assign precaution to patient successfull!');
        } catch (Exception $ex) {
            return redirect()->route('patientPrecautions.edit', $id)->with('toast_error', 'Assign precaution to patient unsuccessfull !');
        }
    }
}
