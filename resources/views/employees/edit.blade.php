<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>

    <h2>Edit Employee</h2>
    <p><a href="{{ route('employees.index') }}">Back to Employee List</a></p>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf
        @method('PUT')

        <label>First Name:</label><br>
        <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" required><br><br>

        <label>Department:</label><br>
        <input type="text" name="department" value="{{ old('department', $employee->department) }}" required><br><br>

        <label>Position:</label><br>
        <input type="text" name="position" value="{{ old('position', $employee->position) }}" required><br><br>

        <label>Salary:</label><br>
        <input type="number" step="0.01" name="salary" value="{{ old('salary', $employee->salary) }}" required><br><br>

        <label>Hire Date:</label><br>
        <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active" {{ old('status', $employee->status) == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="On Leave" {{ old('status', $employee->status) == 'On Leave' ? 'selected' : '' }}>On Leave</option>
            <option value="Terminated" {{ old('status', $employee->status) == 'Terminated' ? 'selected' : '' }}>Terminated</option>
        </select><br><br>

        <button type="submit">Update Employee</button>
    </form>

</body>
</html>
