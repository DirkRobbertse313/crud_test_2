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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No Employees Found']);
        }

        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEmployeeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        $sanitized = $request->validated();

        if (Employee::create($sanitized)) {
            return response()->json(['message' => 'Employee Created Successfully'], 201);
        }

        return response()->json(['message' => 'Something went wrong'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\JsonResponse
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
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\JsonResponse
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
