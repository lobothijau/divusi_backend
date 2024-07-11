<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function store(Request $request) {
        $yy = substr($request->year, -2);
        $code = "";
        if ($request->functional_position == "Engineer") {
            $code = "01";
        } else if ($request->functional_position == "Administrasi") {
            $code = "02";
        } else {
            $code = "03";
        }
        $count = DB::table('employees')->count() + 1;

        $nip = $yy . $code . str_pad($count, 4, '0', STR_PAD_LEFT);

        $item = Employee::create([
            'nip' => $nip,
            'name' => $request->name,
            'functional_position' => $request->functional_position,
            'structural_position' => $request->structural_position,
        ]);

        return response()->json($item, 201);
    }

    public function index() {
        return Employee::all();
    }
}
