@extends('layouts.app')

@section('content')
<div id="chat">
    <ul id="messages">
        <!-- Pesan akan di-render di sini -->
    </ul>
    <form id="message-form">
        @csrf
        <input type="text" id="message" placeholder="Type your message">
        <button type="submit">Send</button>
    </form>
</div>

<script>
    const chatRoomId = {{ $chatRoom->id }};
    window.Echo.private(`chat-room.${chatRoomId}`)
        .listen('MessageSent', (e) => {
            const messages = document.getElementById('messages');
            const messageElement = document.createElement('li');
            messageElement.textContent = `${e.message.user.name}: ${e.message.message}`;
            messages.appendChild(messageElement);
        });

    document.getElementById('message-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = document.getElementById('message').value;

        await fetch(`/chat/${chatRoomId}/messages`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message }),
        });

        document.getElementById('message').value = '';
    });
</script>
@endsection