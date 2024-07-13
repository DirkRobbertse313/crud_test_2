<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json('No Employees Found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $sanitized = $request->validated();

        if (Employee::create($sanitized)) {
            return response()->json(['message' => 'Employee Created Sucessfully', 201]);
        } else {
            return response()->json(['message' => 'Someting went wrong', 500]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = Employee::find($employee);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $sanitized = $request->validated();
        if ($employee->update($sanitized)) {
            return response()->json(['message' => 'Employee successfully Updated']);
        } else {
            return response()->json(['message' => 'Employee could not be Updated'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            return response()->json(['message' => 'Employee successfully deleted'], 200);
        } else {
            return response()->json(['message' => 'Employee could not be deleted'], 500);
        }
    }
}
