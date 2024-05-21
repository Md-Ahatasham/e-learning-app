<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Patient;
use App\Models\PatientActivityLog;
use App\Models\PatientInOutHistory;
use App\Models\PatientPreCaution;
use App\Models\PatientTransferHistory;
use App\Models\PreCaution;
use App\Models\Room;
use App\Models\Rounder;
use App\Models\RoundingHistory;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:patient-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a list of patients.
     * @date: 18-03-2022
     * @return array of patient list
     */

    public function index()
    {
        $data['title'] = "Patient";
        return view('admin_level.patients.index', with(['data' => $data]));
    }


    /**
     * Display datatable patient list.
     * @date: 15-03-2022
     * @return array of patient list
     */

    public function dataTablePatientList()
    {
        $patient_list = Patient::with(['units', 'rooms', 'beds', 'preCaution.precaution'])->orderBy('id', 'desc')->get();
        return datatables($patient_list)
            ->addColumn('patient_picture', function ($row) {
                return '<a href="/patients/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->patient_picture . '"></a>';
            })
            ->addColumn('preferred_name', function ($row) {
                return $row->preferred_name;
            })
            ->addColumn('units', function ($row) {
                return $row['units']['name'];
            })
            ->addColumn('rooms', function ($row) {
                return $row['rooms']['room_no'];
            })
            ->addColumn('beds', function ($row) {
                return $row['beds']['bed_no'];
            })
            ->addColumn('first_name', function ($row) {
                return $row->first_name;
            })
            ->addColumn('last_name', function ($row) {
                return $row->last_name;
            })
            ->addColumn('gender', function ($row) {
                return $this->getGender($row);
            })
            ->addColumn('rounding_interval', function ($row) {
                return $row->interval . " Min";
            })
            ->addColumn('admission_date', function ($row) {
                return date('m-d-Y', strtotime($row->admission_date));
            })
            ->addColumn('precaution', function ($row) {
                $precautions = "";
                foreach ($row['preCaution'] as $list) {
                    $precautions .= '<a class="btn btn-primary btn-xs first mr-1" href="" style="background-color:' . $list['precaution']['color_code'] . '">' . $list['precaution']['pre_caution_name'] . '</a>';
                }
                return $precautions;
            })
            ->rawColumns(['units','rooms','beds','action', 'gender', 'assigned_rounder', 'admission_date', 'rounding_interval', 'precaution', 'patient_picture', 'preferred_name', 'first_name', 'last_name'])->make(true);
    }


    /**
     * Display datatable patient list.
     * @date: 15-03-2022
     * @return array of patient list
     */

    public function getRoundingHistory($id)
    {
        $history = RoundingHistory::with(['rounder', 'rounderInfo'])->where('patient_id', $id)->get();
        return datatables($history)->addColumn('rounder', function ($row) {
            return $row['rounder']['first_name'] . ' ' . $row['rounder']['last_name'];
        })
            ->addColumn('time', function ($row) {
                return date("j F, Y, h:i A", strtotime($row->created_at));
            })
            ->addColumn('tablet', function ($row) {
                return $row['rounderInfo']['assign_tab'];
            })
            ->addColumn('transfer_to', function ($row) {
                $transfer = PatientTransferHistory::orderBy('id', 'ASC')->where(['previous_rounder_id' => $row['rounder']['id'], 'patient_id' => $row->patient_id])->first();
                if (!empty($transfer)) {
                    $rounder = User::where('id', $transfer->current_rounder_id)->first();
                    return $rounder->first_name . ' ' . $rounder->last_name;
                } else {
                    return "N/A";
                }
            })
            ->rawColumns(['time', 'rounder', 'transfer_to'])->make(true);
    }

    /**
     * Display datatable rounding history all activity of a patient.
     * @date: 11-04-2022
     * @return array of patient activity list
     */

    public function getPatientActivityHistory($id)
    {
        $history = PatientActivityLog::with(['userAsEntryBy'])->where('patient_id', $id)->get();
        return datatables($history)->addColumn('user', function ($row) {
            return $row['userAsEntryBy']['first_name'] . ' ' . $row['userAsEntryBy']['last_name'];
        })
            ->addColumn('time', function ($row) {
                return date("j F, Y, h:i A", strtotime($row->created_at));
            })
            ->rawColumns(['time', 'user'])->make(true);
    }

    /**
     * Show the form for creating patient.
     * @date: 18-03-2022
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data = $this->prepareDropDownData();
        $data['rounder_list'] = User::where(['role_id' => 2, 'status' => 1])->get();
        $data['title'] = "Patient";
        return view('admin_level.patients.create', with(['data' => $data]));
    }

    /**
     * Store a newly created resource in storage.
     * @date: 18-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formValidation($request);
        $image_url = asset('dist/img/default_avatar.png');
        if ($request->hasFile('patient_photo')) {
            $image_url = $this->uploadPatientPhoto($request->patient_photo);
        }

        $request->merge(['admission_date' => Carbon::now(), 'patient_picture' => $image_url, 'age' => $this->calculateAge($request->dob), 'entry_by' => Auth::user()->id]);

        try {
            $request->input('action') != "" ? $request->merge(['status' => 5]) : "";
            if ($patient = Patient::create($request->except(['patient_photo', 'precaution', 'action']))) {
                $this->precautionForPatient($patient->id, $request->precaution, "", 1);
                $data['rounderInfo'] = User::with('rounderInfo')->where(['role_id' => 2, 'is_online' => 1])->get();
                $data['patientInfo'] = $patient;
                if ($request->input('action') == 'save_to_tablet') {
                    return view('admin_level.patients.assign_rounder', with(['data' => $data]));
                } else {
                    return redirect()->route('patients.queueList')->with('toast_success', 'Patient Added To Queue');
                }
            }
        } catch (Exception $ex) {
            return redirect()->route('patients.create')->with('toast_error', 'Error! Patient Not Added');
        }
    }

    public function transferHistory($patient_id, $rounder_id, $entry_by, $update = null)
    {
        DB::beginTransaction();
        try {
            if ($update == 1) {
                $find = PatientTransferHistory::where(['patient_id' => $patient_id, 'transfer_status' => 0])->first();
                if (!empty($find)) {
                    PatientTransferHistory::where('patient_id', $find->patient_id)->delete();
                }
            }

            $transfer_patient = new PatientTransferHistory();
            $transfer_patient->previous_rounder_id = 0;
            $transfer_patient->current_rounder_id = $rounder_id;
            $transfer_patient->patient_id = $patient_id;
            $transfer_patient->entry_by = $entry_by;
            $transfer_patient->save();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Store patient precautions in storage.
     * @date: 28-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function precautionForPatient($patient_id, $precautions, $update = null)
    {
        $prepareData = array();
        foreach ($precautions as $key => $precaution) {
            $prepareData[$key]['patient_id'] = $patient_id;
            $prepareData[$key]['pre_caution_id'] = $precaution;
            $prepareData[$key]['entry_by'] = Auth::user()->id;
            $prepareData[$key]['created_at'] = Carbon::now();
            $prepareData[$key]['updated_at'] = Carbon::now();
        }
        try {
            if ($update == 1) {
                $patientSavedPrecaution = PatientPreCaution::where('patient_id', $patient_id)->get();
                $prepareSavedPrecaution = array();
                foreach ($patientSavedPrecaution as $key => $row) {
                    $prepareSavedPrecaution[$key] = $row->pre_caution_id;
                }

                if (sizeof($prepareSavedPrecaution) == sizeof($precautions)) {
                    $checkMatch = array_diff($prepareSavedPrecaution, $precautions);
                    if (empty($checkMatch)) {
                        return true;
                    }
                }

                DB::table('patient_pre_cautions')->where('patient_id', $patient_id)->delete();
            }
            PatientPreCaution::insert($prepareData);
            $this->patientActivityLog($patient_id, $update == 1 ? 'Patient Precaution Updated ' : "Patient Precaution Added");
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    //Will be update soon
    private function transferRounderStore($old_rounder, $new_rounder)
    {
        //Body
    }

    /**
     * Store patient inout history in storage.
     * @date: 23-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function savePatientInOutHistory($patient_id, $admission_date)
    {
        $prepareData = array(['patient_id' => $patient_id, 'admission_date' => $admission_date, 'entry_by' => Auth::user()->id]);
        try {
            PatientInOutHistory::create($prepareData[0]);
            $this->patientActivityLog($patient_id, 'Patient Record Created', 1);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }


    /**
     * Store patient inout history in storage.
     * @date: 23-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function updatePatientInOutHistory($patient_id, $date)
    {
        try {
            PatientInOutHistory::where(['patient_id' => $patient_id, 'discharged_date' => null])->first()->update(['discharged_date' => $date]);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    /**
     * Display the specified resource.
     * @date: 18-03-2022
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */

    public function show(Patient $patient)
    {
        $data['patient'] = Patient::with(['units','rooms','beds','userAsRounder', 'userAsEntryBy', 'preCaution.precaution', 'rounderInfo'])->find($patient->id);
        $data['patient_last_rounding_history'] = RoundingHistory::OrderBy('id', 'Desc')->where('patient_id', $patient->id)->first();
        $data['precautions'] = PreCaution::all();
        $data['title'] = "Patient";
        return view('admin_level.patients.view')->with(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     * @date: 18-03-2022
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */

    public function edit($id = null)
    {
        $data['patient_precaution'] = array();
        $data = $this->prepareDropDownData();
        $data['rounder_list'] = User::where(['role_id' => 2, 'status' => 1])->get();
        $data['patient'] = Patient::with('precaution')->find($id);
        $data['title'] = "Patient";
        foreach ($data['patient']['precaution'] as $row) {
            $data['patient_precaution'][$row->pre_caution_id] = $row['pre_caution_id'];
        }
        if ($this->checkIncommingRequest()) {
            $data['incomming'] = 1;
        }
        return view('admin_level.patients.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @date: 18-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $interval_time_updated = 0;
        $this->formValidation($request);
        if ($request->hasFile('patient_photo')) {
            $image_url = $this->uploadPatientPhoto($request->patient_photo, $patient->patient_picture);
        }
        if (isset($image_url) & !empty($image_url)) {
            $request->merge(['patient_picture' => $image_url]);
        }

        if ($patient->interval != $request->interval) {
            $interval_time_updated = 1;
        }
        $request->merge(['admission_date'=>Carbon::now(),'age' => $this->calculateAge($request->dob), 'entry_by' => Auth::user()->id]);

        try {
            $patient->update($request->except('patient_photo'));
            $interval_time_updated == 1 ? $this->patientActivityLog($patient->id, 'Patient Interval Time Updated') : '';
            $this->precautionForPatient($patient->id, $request->precaution, 1);
            return $request->check_incomming == 1 ? redirect()->route('patients.show', $patient->id)->with('toast_success', 'Patient Updated successfully!') : redirect()->route('patients.index')->with('toast_success', 'Patient Updated successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Patient Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 25-03-2022
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function deletePatient($id)
    {
        try {
            $patient = Patient::where('id', $id)->first();
            $this->deleteImage($patient->patient_picture);
            $patient->delete();
            return redirect()->route('patients.index')->with('toast_success', 'Patient Deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Patient Is Not Deleted. Dependant data found');
        }
    }


    /**
     * Prepare validation for patient request.
     * @date: 16-03-2022
     * @param  request
     * @return validation
     */
    public function formValidation($request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'preferred_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'unit' => 'required',
            'room' => 'required',
            'bed' => 'required',
            'address' => 'required',
            'preferred_language' => 'required',
            'emergency_contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15',
            'patient_photo' => 'image|mimes:jpeg,png,jpg,JPEG,JPG,PNG|max:2048',
            'precaution' => 'required',
            'interval' => 'required',
            'unique_stay_id' => 'required',

        ]);
    }

    /**
     * Prepare all combo data.
     * @date: 22-03-2022
     * @param  null
     * @return array
     */
    public function prepareDropDownData()
    {
        $data['unit_list'] = Unit::all();
        $data['room_list'] = Room::all();
        $data['bed_list'] = Bed::all();
        $data['gender'] = $this->gender();
        $data['status'] = $this->status();
        $data['language'] = $this->language();
        $data['precaution_list'] = PreCaution::all();
        $data['interval'] = $this->intervalSchedule();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     * @date: 18-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function dischargePatient($id)
    {
        try {
            $patient = Patient::where('id', $id)->first();
            $patient->update(['status' => 0]);
            $this->updatePatientInOutHistory($patient->id, date('Y-m-d'));
            $this->patientActivityLog($id, 'Patient Discharged');
            return redirect()->route('patients.index')->with('toast_success', 'Patient Updated successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Patient Not Updated');
        }
    }

    public function assign(Request $request)
    {
        Patient::where('id', $request->patient_id)->update(array('status' => $request->status, 'assigned_rounder_id' => $request->assign_rounder_id, 'admission_date' => now()));
        $this->savePatientInOutHistory($request->patient_id, now());
        $this->transferHistory($request->patient_id, $request->assign_rounder_id, $request->entry_by);
        return redirect()->route('patients.index')->with('toast_success', 'Patient Added To Tablet Successfully !');
    }

    public function assignRounderToPatient($patient, $action)
    {
        $data['rounderInfo'] = User::with('rounderInfo')->where(['role_id' => 2, 'is_online' => 1])->get();
        $data['patientInfo'] = $patient;
        if ($action == 'save_to_tablet') {
            return view('admin_level.patients.assign_rounder', with(['data' => $data]));
        } else {
            return redirect()->route('patients.queueList')->with('toast_success', 'Patient Added To Queue');
        }
    }

    public function getQueueList()
    {
        $data['title'] = "Queue List";
        return view('admin_level.patients.queue_list', with(['data' => $data]));
    }

    public function assignRounder($id)
    {
        $data['rounderInfo'] = User::with('rounderInfo')->where(['role_id' => 2, 'is_online' => 1])->get();
        $data['patientInfo'] = Patient::where('id', $id)->first();
        return  view('admin_level.patients.assign_rounder', with(['data' => $data]));
    }

    public function dischargedPatientlist()
    {
        $data['title'] = "Discharged Patient List";
        return view('admin_level.patients.discharged_patient', with(['data' => $data]));
    }



    /**
     * Display datatable patient list.
     * @date: 15-03-2022
     * @return array of patient list
     */

    public function getQueuePatientList()
    {
        $patient_list = Patient::with(['units', 'rooms', 'beds','preCaution.precaution'])->where('status', 5)->orderBy('id', 'desc')->get();
        return datatables($patient_list)
            ->addColumn('action', function ($row) {
                return '<a href="/assignRounder/' . $row->id . '" class="btn btn-primary btn-xs second"><em class="fa fa-edit"></em></a>';
            })

            ->addColumn('patient_picture', function ($row) {
                return '<a href="/patients/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->patient_picture . '"></a>';
            })
            ->addColumn('unit', function ($row) {
                return $row['units']['name'];
            })
            ->addColumn('room', function ($row) {
                return $row['rooms']['room_no'];
            })
            ->addColumn('bed', function ($row) {
                return $row['beds']['bed_no'];
            })
            ->addColumn('first_name', function ($row) {
                return $row->first_name;
            })
            ->addColumn('last_name', function ($row) {
                return $row->last_name;
            })
            ->addColumn('gender', function ($row) {
                return $this->getGender($row);
            })
            ->addColumn('rounding_interval', function ($row) {
                return $row->interval . " Min";
            })

            ->addColumn('precaution', function ($row) {
                $precautions = "";
                foreach ($row['preCaution'] as $list) {
                    $precautions .= '<a class="btn btn-primary btn-xs first mr-1" href="" style="background-color:' . $list['precaution']['color_code'] . '">' . $list['precaution']['pre_caution_name'] . '</a>';
                }
                return $precautions;
            })

            ->rawColumns(['action', 'gender', 'assigned_rounder', 'admission_date', 'rounding_interval', 'precaution', 'patient_picture', 'preferred_name', 'first_name', 'last_name'])->make(true);
    }

     
    /**
     * Display datatable patient list.
     * @date: 15-03-2022
     * @return array of patient list
     */

    public function dischargedPatient()
    {
        $patient_list = Patient::with(['units', 'rooms', 'beds','preCaution.precaution'])->where('status',0)->orderBy('id', 'desc')->get();
        return datatables($patient_list)
            ->addColumn('patient_picture', function ($row) {
                return '<a href="/patients/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->patient_picture . '"></a>';
            })
            ->addColumn('unit', function ($row) {
                return $row['units']['name'];
            })
            ->addColumn('room', function ($row) {
                return $row['rooms']['room_no'];
            })
            ->addColumn('bed', function ($row) {
                return $row['beds']['bed_no'];
            })
            ->addColumn('first_name', function ($row) {
                return $row->first_name;
            })
            ->addColumn('last_name', function ($row) {
                return $row->last_name;
            })
            ->addColumn('gender', function ($row) {
                return $this->getGender($row);
            })
            ->addColumn('rounding_interval', function ($row) {
                return $row->interval . " Min";
            })
            ->addColumn('admission_date', function ($row) {
                return date('m-d-Y', strtotime($row->admission_date));
            })
            ->addColumn('precaution', function ($row) {
                $precautions = "";
                foreach ($row['preCaution'] as $list) {
                    $precautions .= '<a class="btn btn-primary btn-xs first mr-1" href="" style="background-color:' . $list['precaution']['color_code'] . '">' . $list['precaution']['pre_caution_name'] . '</a>';
                }
                return $precautions;
            })
            ->rawColumns(['gender', 'assigned_rounder', 'admission_date', 'rounding_interval', 'precaution', 'patient_picture', 'first_name', 'last_name'])->make(true);
    }
    /**
     * Display Room List By Unit Id.
     * @date: 19-05-2022
     * @param  empty
     * @return room list
     */
    public function getRoomListByUnitId()
    {
        $roomList = Room::where('unit_id', $_GET['id'])->get();
        return response()->json(['roomList' => $roomList]);
    }

    /**
     * Display Bed List By Room Id.
     * @date: 19-05-2022
     * @param  empty
     * @return Bed list
     */
    public function getBedListByRoomId()
    {
        $bedList = Bed::where('room_id', $_GET['id'])->get();
        return response()->json(['bedList' => $bedList]);
    }
}
