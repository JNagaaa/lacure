@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notifications</h1>
    <ul>
        @foreach ($admin->notifications as $notification)
            <li>
                {!! $notification->data['message'] !!}
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
</div>
@endsection
