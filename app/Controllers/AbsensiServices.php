<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\AttendanceModel;

class AbsensiServices extends ResourceController
{

    use ResponseTrait;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->userModel = new UserModel();

        $token = (isset($_REQUEST['token'])) ? $_REQUEST['token'] : "";
        if ($token !== "3eb561821782ed487d59903770eac30d") {
            echo 'Access denied';
            exit;
        }
    }

    // get employee by id
    public function getEmployeeById()
    {
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
        $data = $this->userModel->where(['userId' => $id])->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    // get attandance employee
    public function getAttandance()
    {
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
        $attedance = $this->attendanceModel
            ->join('users', 'users.userId = attendances.user_id', 'left')
            ->orderBy('DATE(users.created_at)', 'DESC')
            ->where(['users.userId' => $id])->findAll();

        $user = array();
        foreach ($attedance as $row) {
            // get late status
            $entry_absent = $row ? date_format(date_create($row['signin_at']), 'Hi') : null;
            $late = (int)$entry_absent >= 800;

            $result = array(
                "attendanceId" => $row["attendanceId"],
                "user_id" => $row["user_id"],
                "fullname" => $row["fullname"],
                "ID_PKL" => $row["ID_PKL"],
                "category" => $row["category"],
                "late_status" =>  $late,
                "signin_at" => $row["signin_at"],
                "signout_at" => $row["signout_at"],
            );
            $user[] = $result;
        }

        return $this->respond($user, 200);
    }

    public function countEvaluation()
    {
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
        $attedance = $this->attendanceModel
            ->join('users', 'users.userId = attendances.user_id', 'left')
            ->orderBy('DATE(users.created_at)', 'DESC')
            ->where(['users.userId' => $id])->findAll();

        $user = array();
        foreach ($attedance as $row) {
            // get late status
            $entry_absent = $row ? date_format(date_create($row['signin_at']), 'Hi') : null;
            $late = (int)$entry_absent >= 800;

            $result = array(
                "attendanceId" => $row["attendanceId"],
                "user_id" => $row["user_id"],
                "fullname" => $row["fullname"],
                "ID_PKL" => $row["ID_PKL"],
                "category" => $row["category"],
                "late_status" =>  $late,
                "signin_at" => $row["signin_at"],
                "signout_at" => $row["signout_at"],
            );
            $user[] = $result;
        }

        // config periode absensi
        $periode_pkl = $this->userModel->where(['userId' => $id])->first(); // 6 Bulan
        $hari_kerja = 22; // 22 hari dalam 1 bulan
        $total_hari_kerja = $periode_pkl['internship_length'] * $hari_kerja;

        $absen_tidak_masuk = 0;
        foreach ($user as $key) {
            if ($key["late_status"] == true) {
                $absen_tidak_masuk++;
            }
        }

        $result = array (
            "total_disiplin" => round((($total_hari_kerja-$absen_tidak_masuk)/$total_hari_kerja)*100),
            "absen_tidak_masuk" => $absen_tidak_masuk,
            "total_hari_kerja" => $total_hari_kerja
        );

        return $this->respond($result, 200);
    }
}
