<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Response;
use Exception;

class DashboardController extends Controller
{
    /**
     * @var DashboardService
     */
    protected $dashboardService;

    /**
     * DashboardController constructor.
     * * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }

    /**
     * Handle incoming request to display the administrative dashboard view.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function Dashboard()
    {
        try {
            // Delegate core data fetching logic to the service layer
            $data = $this->dashboardService->getDashboardData();

            // Render view with data arrays safely mapped
            return view('admin.dashboard.dashboard', $data);

        } catch (Exception $e) {
            // Handle failure gracefully by flashing error message to the session
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}