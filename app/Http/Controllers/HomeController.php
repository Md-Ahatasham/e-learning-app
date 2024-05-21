<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['top_headline'] = "Dashboard";
        $data['title'] = "Dashboard";
        //$data['recent_admitted_patient'] = Patient::with(['userAsRounder', 'preCaution.precaution'])->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        //$data['recent_discharged_patient'] = Patient::with(['userAsRounder', 'preCaution.precaution'])->where('status', 0)->orderBy('updated_at', 'DESC')->take(3)->get();
        return view('admin_level.dashboard.index', with(['data' => $data]));
//        return view('admin_level.patients.index', with(['data' => $data]));
    }

    /**
     * Display datatable patient list.
     * @date: 15-03-2022
     * @return array of patient list
     */

    public function dataTablePatientList()
    {
        $patient_list = Patient::where('status', 1)->with(['userAsRounder', 'preCaution.precaution'])->orderBy('id', 'desc')->get();
        return datatables($patient_list)->addColumn('assigned_rounder', function ($row) {
            return $row['userAsRounder']['first_name'] . ' ' . $row['userAsRounder']['last_name'];
        })
            ->addColumn('rounding_interval', function ($row) {
                return $row->interval . " min";
            })
            ->addColumn('patient_picture', function ($row) {
                return '<a href="/patients/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->patient_picture . '"></a>';
            })
            ->addColumn('preferred_name', function ($row) {
                return '<a href="/patients/' . $row->id . '">' . $row->first_name . ' ' . $row->last_name . '</a>';
            })
            ->addColumn('gender', function ($row) {
                return $this->getGender($row);
            })
            ->addColumn('precaution', function ($row) {
                $precautions = "";
                foreach ($row['preCaution'] as $list) {
                    $precautions .= '<a class="btn btn-primary btn-xs first mr-1" href="" style="background-color:' . $list['precaution']['color_code'] . '">' . $list['precaution']['pre_caution_name'] . '</a>';
                }
                return $precautions;
            })
            ->rawColumns(['assigned_rounder', 'rounding_interval', 'precaution', 'patient_picture', 'preferred_name','gender'])->make(true);
    }
}
