<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use LDAP\Result;

class ReportingController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $result = collect();
        foreach ($employees as $employee) {
            $hadir = Attendance::where('employee_id', $employee->id)->where('status', 'hadir')->count();
            $sakit = Attendance::where('employee_id', $employee->id)->where('status', 'sakit')->count();
            $izin = Attendance::where('employee_id', $employee->id)->where('status', 'izin')->count();
            $alpa = Attendance::where('employee_id', $employee->id)->where('status', 'alpa')->count();
            $total = $hadir + $sakit + $izin + $alpa;
            $result->add([
                'nip' => $employee->nip,
                'name' => $employee->name,
                'functional_position' => $employee->functional_position,
                'structural_position' => $employee->structural_position,
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
                'alpha' => $alpa,
                'total' => $total,
            ]);
        }
        return response()->json($result, 200);
    }
}
