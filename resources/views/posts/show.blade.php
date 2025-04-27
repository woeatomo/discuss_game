@extends('layouts.app')

@section('content')
<div class="post">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <!-- Like Button -->
    <div>
        <button id="like-button" onclick="toggleLike()">Like</button>
        <span id="likes-count">{{ $post->likes()->count() }}</span> Likes
    </div>

    <!-- Comments Section -->
    <div>
        <h3>Comments</h3>
        <form id="comment-form" onsubmit="addComment(event)">
            @csrf
            <textarea id="comment-content" placeholder="Add a comment..." required></textarea>
            <button type="submit">Submit</button>
        </form>

        <ul id="comments-list">
            @foreach($post->comments as $comment)
                <li>
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    async function toggleLike() {
        const response = await fetch('/posts/{{ $post->id }}/like', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        });
        const data = await response.json();
        document.getElementById('likes-count').innerText = data.likes_count;
    }

    async function addComment(event) {
        event.preventDefault();
        const content = document.getElementById('comment-content').value;

        const response = await fetch('/posts/{{ $post->id }}/comments', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ content }),
        });

        const data = await response.json();
        const commentList = document.getElementById('comments-list');
        const newComment = document.createElement('li');
        newComment.innerHTML = `<strong>${data.comment.user.name}</strong>: ${data.comment.content}`;
        commentList.appendChild(newComment);

        document.getElementById('comment-content').value = '';
    }
</script>
@endsection