<?php

namespace App\Http\Controllers;
use App\Services\Dashboard\DashboardService;
use Illuminate\Contracts\Support\Renderable;


class HomeController extends Controller
{
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $data['breadcrumb'] = $this->getBreadcrumb("Dashboard", "Dashboard");
        $data['dashboardInfo'] = $this->service->getAllInfo();
        return view('backend.dashboard.index', with(['data' => $data]));
    }

}
