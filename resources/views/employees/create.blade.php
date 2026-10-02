<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>

    <h2>Add Employee</h2>
    <p><a href="{{ route('employees.index') }}">Back to Employee List</a></p>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <label>First Name:</label><br>
        <input type="text" name="first_name" value="{{ old('first_name') }}" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="{{ old('last_name') }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>Department:</label><br>
        <input type="text" name="department" value="{{ old('department') }}" required><br><br>

        <label>Position:</label><br>
        <input type="text" name="position" value="{{ old('position') }}" required><br><br>

        <label>Salary:</label><br>
        <input type="number" step="0.01" name="salary" value="{{ old('salary') }}" required><br><br>

        <label>Hire Date:</label><br>
        <input type="date" name="hire_date" value="{{ old('hire_date') }}" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="On Leave" {{ old('status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
            <option value="Terminated" {{ old('status') == 'Terminated' ? 'selected' : '' }}>Terminated</option>
        </select><br><br>

        <button type="submit">Save Employee</button>
    </form>

</body>
</html>
