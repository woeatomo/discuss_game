@extends('layouts.app')

@section('content')
<div>
    <h1>Forum Discussions</h1>
    <form method="POST" action="{{ route('discussion.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Create Discussion</button>
    </form>
    <ul>
        @foreach($discussions as $discussion)
            <li>
                <strong>{{ $discussion->title }}</strong>
                <p>{{ $discussion->content }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection