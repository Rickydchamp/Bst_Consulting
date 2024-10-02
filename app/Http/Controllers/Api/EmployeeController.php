<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Mail\EmployeeMail;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file;

        \Excel::import(new EmployeeImport, $file);

        $employees = Employee::all();

        foreach ($employees as $e)
        {
            Mail::to($e->email)->send(new EmployeeMail);
        }

        return response()->json([
            'status' => true,
            'message' => 'Spreadsheet imported successfully and a mail was sent successfully',
        ]);
    }

    public function all()
    {
        $employees = Employee::all();

        return response()->json([
            'status' => true,
            'all_employees' => $employees,
        ]);
    }

    public function search(Request $request)
    {
        $employees = Employee::where('first_name', 'like', '%' . $request->search . '%')->orWhere('last_name', 'like', '%' . $request->search . '%')->orWhere('phone', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->latest()->get();

        return response()->json([
            'success' => true,
            'all_employees' => $employees,
        ]);
    }
}
