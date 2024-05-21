<?php

namespace App\Http\Controllers;

use App\Models\Rounder;
use App\Models\RounderActivityLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

class RounderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:rounder-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:rounder-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rounder-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rounder-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a list of rounders.
     * @date: 04-04-2022
     * @return array of rounder list
     */

    public function index()
    {
        $data['title'] = "Rounder";
        return view('admin_level.rounders.index', with(['data' => $data]));
    }

    /**
     * Display a list of rounders.
     * @date: 15-04-2022
     * @return array of rounder list
     */

    public function roundingActivity()
    {
        $data['rounder_list'] = User::with(['rounderInfo', 'patient'])->where(['role_id' => 2, 'status' => 1])->orderBy('id', 'desc')->get();
        $data['title'] = "Tablet";
        return view('admin_level.tablets.roundingActivity', with(['data' => $data]));
    }


    /**
     * Display datatable rounding history all activity of a patient.
     * @date: 11-04-2022
     * @return array of patient activity list
     */

    public function tabletActivityByrounderId($id)
    {
        $activityLog = RounderActivityLog::with(['userAsEntryBy'])->where('rounder_id', $id)->get();
        return datatables($activityLog)->addColumn('user', function ($row) {
            return $row['userAsEntryBy']['first_name'] . ' ' . $row['userAsEntryBy']['last_name'];
        })
            ->addColumn('time', function ($row) {
                return ($row->created_at)->format('m-d-Y h:i');
            })
            ->rawColumns(['time', 'user'])->make(true);
    }

    /**
     * Display datatable rounder list.
     * @date: 04-04-2022
     * @return array of rounder list
     */

    public function dataTableRounderList()
    {
        $rounder_list = User::with('rounderInfo')->where(['role_id' => 2])->orderBy('id', 'desc')->get();
        return datatables($rounder_list)
            ->addColumn('first_name', function ($row) {
                return '<a href="/rounders/' . $row->id . '">' . $row->first_name .'</a>';
            })
            ->addColumn('last_name', function ($row) {
                return '<a href="/rounders/' . $row->id . '">' .  $row->last_name . '</a>';
            })
            ->addColumn('employee_id', function ($row) {
                return   $row->user_code ;
            })
            ->addColumn('dob', function ($row) {
                return   $row['rounderInfo']['dob'] ;
            })
            ->addColumn('status', function ($row) {
                return  ($row->status == 2) ? "Pending" : (($row->status == 1)  ? "Active" : "Deactive");
            })
            
            ->rawColumns(['first_name', 'last_name', 'employee_id', 'dob', 'status'])->make(true);
    }

     /**
     * Display datatable rounder list.
     * @date: 04-04-2022
     * @return array of rounder list
     */

    public function dataTableTabletList()
    {
        $rounder_list = User::with('patient')->where(['role_id' => 2])->orderBy('id', 'desc')->get();
        return datatables($rounder_list)->addColumn('action', function ($row) {
            return '<a href="/rounders/' . $row->id . '/edit" class="btn btn-primary btn-xs second"><em class="fa fa-edit"></em></a>
            <a href="/deleteRounderList/' . $row->id . '" onclick="deleteItem(event)" class="btn btn-danger btn-xs"><em class="fas fa-trash-alt"></em></a>';
        })
            ->addColumn('name', function ($row) {
                return '<a href="/rounders/' . $row->id . '">'.$row->first_name.' '.$row->last_name.'</a>';
            })
            ->addColumn('profile_photo', function ($row) {
                return '<a href="/rounders/' . $row->id . '"><img class="patient_image rounded-circle" alt="patient_avatar" src="' . $row->profile_photo . '"></a>';
            })
            ->addColumn('assigned_patients', function ($row) {
                return '<p class="text-center">' . count($row['patient']) . '</p>';
            })
            ->addColumn('time_since_last_sync', function () {
                return '34 Min Ago';
            })
            ->addColumn('tablet_in_use', function () {
                return 'Tablet 3';
            })
            ->addColumn('last_location', function () {
                return 'N/A';
            })
            ->rawColumns(['action', 'name', 'assigned_patients', 'time_since_last_sync', 'last_location','tablet_in_use','profile_photo'])->make(true);
    }

    /**
     * Show the form for creating rounder.
     * @date: 02-03-2022
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['title'] = "Rounder";
        return view('admin_level.rounders.create', with(['data' => $data]));
    }

    /**
     * Store a newly created resource in storage.
     * @data: 04-04-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formValidation($request);
        $imageUrl = asset('dist/img/default_avatar.png');
        if ($request->hasFile('profile_image')) {
            $imageUrl = $this->uploadRounderPhoto($request->profile_image);
        }

        $input = $request->all();
        $input['profile_photo'] = $imageUrl;
        $input['hospital_code'] = 123456;
        $input['user_code'] = $input['employee_id'];
        $input['status'] = 2;
        $input['role_id'] = 2;
        $user = User::create($input);
        Rounder::create(['user_id' => $user->id, 'dob' => $input['date_of_birth'], 'age' => $this->calculateAge($input['date_of_birth'])]);
        return redirect()->route('rounders.index')->with('toast_success', 'Rounder created successfully');
    }

    /**
     * Display the specified resource.
     * @date: 04-04-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $data['rounder'] = User::with('rounderInfo')->where('id', $id)->first();
        $data['title'] = "Rounder";
        return view('admin_level.rounders.view')->with(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     * @date: 04-04-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['rounder'] = User::with('rounderInfo')->where('id', $id)->first();
        $data['title'] = "Rounder";
        return view('admin_level.rounders.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @date: 04-04-2022
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->formValidation($request);
        $rounder = User::where('id', $id)->first();
        if ($request->hasFile('rounder_image')) {
            $image_url = $this->uploadRounderPhoto($request->rounder_image, $rounder->profile_photo);
        }
        if (isset($image_url) & !empty($image_url)) {
            $request->merge(['profile_photo' => $image_url]);
        }
        try {
            $rounder->update($request->except(['rounder_image', 'date_of_birth']));
            $request->merge(['age' => $this->calculateAge($request->date_of_birth), 'dob' => $request->date_of_birth]);
            Rounder::where('user_id', $id)->first()->update($request->only(['age', 'dob']));
            return redirect()->route('rounders.index')->with('toast_success', 'Rounder Updated successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Rounder Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @date: 04-04-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRounder($id)
    {
        try {
            $rounder = User::where('id', $id)->first();
            $rounder->delete();
            return redirect()->route('rounders.index')->with('toast_success', 'Rounder Deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Rounder Is Not Deleted');
        }
    }

    /**
     * activate or deactivate rounder.
     * @date: 04-04-2022
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        try {
            $rounder = User::where('id', $id)->first();
            $rounder->status == 1 ? $rounder->update(['status' => 0]) : $rounder->update(['status' => 1]);
            return redirect()->route('rounders.show', $id)->with('toast_success', 'Rounder Status Changed !');
        } catch (Exception $ex) {
            return redirect()->back()->with('toast_error', 'Error! Rounder Status Not Changed');
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
            'employee_id' => 'required',
            'date_of_birth' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,JPEG,JPG,PNG,gif,GIF|max:2048'
        ]);
    }
}
