@extends('layouts.admin_header')

@section('content')
<div class="container" style="margin-top: 30px;">
    <h2 style="margin-bottom: 20px;">All Feedbacks</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background: #1a1a1a; color: white; border-collapse: collapse;">
        <thead>
            <tr style="background: #4CAF50; color: white;">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
                <tr style="border-bottom: 1px solid #444;">
                    <td>{{ $feedback->id }}</td>
                    <td>{{ $feedback->name }}</td>
                    <td>{{ $feedback->email }}</td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $feedback->rating)
                                <span style="color: gold;">★</span>
                            @else
                                <span style="color: #555;">☆</span>
                            @endif
                        @endfor
                    </td>
                    <td>{{ $feedback->message }}</td>
                    <td>{{ $feedback->created_at->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('feedback.delete', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this feedback?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: white; background: #e74c3c; border: none; padding: 5px 10px; border-radius: 4px;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
