@include('layouts.header')

@section('content')
<div class="container" style="margin-top: 30px;">
    <h2 class="mb-4">All Feedbacks</h2>

    @if($feedbacks->isEmpty())
        <div class="alert alert-warning">
            No feedbacks available.
        </div>
    @else
        <div class="feedback-list">
            @foreach($feedbacks as $feedback)
                <div class="feedback-item" style="border-bottom: 1px solid #ddd; padding: 15px;">
                    <div class="feedback-header d-flex justify-content-between">
                        <h4 class="feedback-name">{{ $feedback->name }}</h4>
                        <small class="text-muted">{{ $feedback->created_at->format('d-m-Y') }}</small>
                    </div>
                    <p><strong>Email: </strong>{{ $feedback->email }}</p>

                    <div class="feedback-rating">
                        <strong>Rating: </strong>
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $feedback->rating ? 'filled' : 'empty' }}">★</span>
                        @endfor
                    </div>

                    <p><strong>Message:</strong></p>
                    <p>{{ $feedback->message }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@include('layouts.footer')
