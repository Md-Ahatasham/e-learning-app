<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientTransferHistory;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notification-list', ['only' => ['index', 'show']]);
    }
    /**
     * Display a list of notification.
     * @date: 26-04-2022
     * @return array of notification list
     */
    public function index()
    {
        $data['title'] = "Notification";
        DB::table('notifications')->update(['read_at' => Carbon::now()]);
        return view('admin_level.notifications.index', with(['data' => $data]));
    }

    /**
     * Display datatable notification list.
     * @date: 26-04-2022
     * @return array of notification list
     */

    public function dataTableNotificationList()
    {
        $patient_list = Notification::with(['rounder', 'patient'])->orderBy('id', 'desc')->get();
        return datatables($patient_list)
            // ->addColumn('action', function ($row) {
            //     return '<a class="edit_notification btn btn-primary btn-xs second" id="' . $row->id . '"><em class="fa fa-edit"></em></a>';
            // })
            ->addColumn('rounder', function ($row) {
                return $row['rounder']['first_name'] . ' ' . $row['rounder']['last_name'];
            })
            ->addColumn('patient', function ($row) {
                return $row['patient']['first_name'] . ' ' . $row['patient']['last_name'];
            })
            ->rawColumns(['action', 'rounder', 'patient'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        $data['rounder'] = User::where(['role_id' => 2, 'status' => 1])->orderBy('id', 'desc')->get();
        $data['result'] = Notification::with('patient')->find($_GET['id']);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $notification = Notification::find($_GET['id']);
            Patient::where('id', $notification->patient_id)->update(['assigned_rounder_id' => $request->rounder_id]);
            $transfer_patient = new PatientTransferHistory();
            $transfer_patient->previous_rounder_id = $notification->rounder_id;
            $transfer_patient->current_rounder_id = $request->rounder_id;
            $transfer_patient->patient_id = $notification->patient_id;
            $transfer_patient->entry_by = Auth::user()->id;
            $transfer_patient->save();
            return redirect()->route('notifications.index')->with('toast_success', 'Patient Assigned !');
        } catch (Exception $ex) {
            return redirect()->route('notifications.index')->with('toast_error', 'Error Occured. Patient Not Assigned !');
        }
    }

    /**
     * count unread notification
     * @date: 27-04-2022
     * @param  null
     * @return array
     */
    public function unreadNotificationCount()
    {
        $data['result'] = Notification::whereNull('read_at')->count();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function updateNotification(Request $request)
    {
        return DB::table('notifications')->update(['read_at' => Carbon::now()]);
    }
}
