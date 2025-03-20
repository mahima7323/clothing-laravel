@extends('layouts.admin_header')

@section('content')
<div class="container mt-5">
    <h2>User List</h2>

    <!-- User Table -->
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Gender</th>
                <th>City</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->cno }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Inline CSS for User Table -->
<style>
    /* Container Styling */
    .container {
        max-width: 1200px;
        margin-top: 30px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Heading Styling */
    h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    /* Table Styling */
    table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        font-size: 14px;
    }

    table th, table td {
        text-align: center;
        padding: 12px;
        border: 1px solid #ddd;
    }

    /* Table Header Styling */
    table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    /* Table Body Row Styling */
    table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Table Body Text Styling */
    table tbody td {
        color: #555;
    }

    /* Table Row Hover Styling */
    table tbody tr:hover {
        background-color: #e9f5ff;
        cursor: pointer;
    }

    /* Pagination Styling */
    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 4px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding: 10px;
        }

        table th, table td {
            font-size: 12px;
        }

        .pagination a {
            padding: 6px 12px;
        }
    }
</style>

@endsection
