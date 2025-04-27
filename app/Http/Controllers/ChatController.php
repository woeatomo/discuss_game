use App\Events\MessageSent;

public function sendMessage(Request $request, ChatRoom $chatRoom)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $message = $chatRoom->messages()->create([
        'user_id' => auth()->id(),
        'message' => $request->message,
    ]);

    // Memancarkan event ke WebSocket
    broadcast(new MessageSent($message))->toOthers();

    return response()->json($message);
}