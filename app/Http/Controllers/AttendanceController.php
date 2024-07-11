<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $attendance =  Attendance::create([
            'employee_id' => $request->employee_id,
            'status' => $request->status,
            'notes' => $request->notes,
            'date' => $request->date
        ]);

        return response()->json($attendance, 201);
    }
}
