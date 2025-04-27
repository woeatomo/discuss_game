@extends('layouts.app')

@section('content')
<div>
    <h1>Chat Rooms</h1>
    <ul>
        @foreach($chatRooms as $chatRoom)
            <li><a href="{{ route('chat.messages', $chatRoom) }}">{{ $chatRoom->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection