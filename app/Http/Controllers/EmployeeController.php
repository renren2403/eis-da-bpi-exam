<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.view', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name'  => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'email'      => ['required', 'email', 'max:100', 'unique:employees,email'],
            'phone'      => ['required', 'digits:11'],
            'department' => ['required', 'string', 'max:50'],
            'position'   => ['required', 'string', 'max:50'],
            'salary'     => ['required', 'numeric', 'min:0'],
            'hire_date'  => ['required', 'date'],
            'status'     => ['required', Rule::in(['Active', 'On Leave', 'Terminated'])],
        ], [
            'first_name.regex' => 'The first name must not contain numbers.',
            'last_name.regex'  => 'The last name must not contain numbers.',
            'phone.digits'     => 'The phone number must be exactly 11 digits.',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'New Employee registered successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

       public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'last_name'  => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'email'      => ['required', 'email', 'max:100', Rule::unique('employees')->ignore($employee->id)],
            'phone'      => ['required', 'digits:11'],
            'department' => ['required', 'string', 'max:50'],
            'position'   => ['required', 'string', 'max:50'],
            'salary'     => ['required', 'numeric', 'min:0'],
            'hire_date'  => ['required', 'date'],
            'status'     => ['required', Rule::in(['Active', 'On Leave', 'Terminated'])],
        ], [
            'first_name.regex' => 'The first name must not contain numbers.',
            'last_name.regex'  => 'The last name must not contain numbers.',
            'phone.digits'     => 'The phone number must be exactly 11 digits.',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee info updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee record deleted successfully!');
    }
}
