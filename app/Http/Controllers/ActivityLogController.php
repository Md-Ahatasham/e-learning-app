<?php

namespace App\Http\Controllers;

use App\Models\UserActivityLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $rounders = UserActivityLog::with('userInfo')->orderBy('id', 'DESC')->get();
        $breadcrumb_data['title'] = "Activity log";
        $breadcrumb_data['headline'] = "Activity Log List";
        return view('backend.activityLogs.index', with(['users_log' => $rounders, 'data' => $breadcrumb_data]));
    }
}
