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
            return response()->json(['message' => 'Someting went wrong', 422]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }
    /**
     * Edit the specified resource.
     */
    public function edit(Employee $employee)
    {
        return response()->json(['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $sanitized = $request->validated();
            $employee->update($sanitized);

            return response()->json(['message' => 'Employee successfully updated']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee could not be updated', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return response()->json(['message' => 'Employee successfully deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee could not be deleted', 'error' => $e->getMessage()], 500);
        }
    }
}
