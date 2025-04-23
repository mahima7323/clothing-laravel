@extends('layouts.admin_header')

@section('content')
<div class="user-list-container">
    <div class="header">
        <h2>User Management</h2>
    </div>

    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-id">{{ $user->id }}</td>
                    <td class="text-name">{{ $user->name }}</td>
                    <td class="text-email">{{ $user->email }}</td>
                    <td class="text-contact">{{ $user->cno }}</td>
                    <td class="text-gender">{{ ucfirst($user->gender) }}</td>
                    <td class="text-city">{{ $user->city }}</td>
                    <td class="text-date">{{ $user->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="no-data">No users available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Custom CSS with Font Colors -->
<style>
    .user-list-container {
        max-width: 1100px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .header h2 {
        font-size: 28px;
        font-weight: 600;
        color: #34495e;
        margin-bottom: 30px;
        text-align: center;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    .user-table thead {
        background-color: #2c3e50;
        color: #ffffff;
    }

    .user-table th, .user-table td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .user-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
    }

    /* Font Colors */
    .text-id { color: #7f8c8d; }
    .text-name { color: #2980b9; }
    .text-email { color: #8e44ad; }
    .text-contact { color: #16a085; }
    .text-gender { color: #d35400; }
    .text-city { color: #c0392b; }
    .text-date { color: #2c3e50; }

    @media (max-width: 768px) {
        .user-list-container {
            padding: 20px;
        }

        .user-table th, .user-table td {
            font-size: 13px;
            padding: 10px;
        }
    }
</style>
@endsection
