<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\JobModel;
use App\Models\UserModel;
use App\Models\ReportModel;
use DateTime;

class HomeController extends BaseController
{
    protected $jobModel, $userModel, $attedanceModel;

    public function __construct()
    {
        $this->jobModel = new JobModel();
        $this->userModel = new UserModel();
        $this->attedanceModel = new AttendanceModel();
        $this->reportModel = new ReportModel();

        if (session()->get('level') != "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        // Get Today Date
        $today = date('Y-m-d');

        $data = [
            // Sidebar
            'page' => 'dashboard',

            // Employees
            'task_completed' => $this->reportModel->getSum(),

            'total_employees' => $this
                ->userModel
                ->countAllResults(),

            // Attendances
            'employee_presence' => $this
                ->attedanceModel
                ->where("category", "hadir")
                ->where('DATE(created_at)', $today)
                ->countAllResults(),

            'employee_sick' => $this
                ->attedanceModel
                ->where("category", "sakit")
                ->where('DATE(created_at)', $today)
                ->countAllResults(),

            'employee_leave' => $this
                ->attedanceModel
                ->where('DATE(signout_at)', $today)
                ->countAllResults(),
        ];

        echo view('layouts/pages/admin/dashboard/index', $data);
    }
}
