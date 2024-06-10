<?php
namespace App\Services\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Routine\RoutineRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardService extends Controller {

    public function getAllInfo()
    {
        return app()->make(UserRepository::class)->getUserRoutine(Auth::user()->role_id == 2 ? Auth::user()->id : '');
    }

}
