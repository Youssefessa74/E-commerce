<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\MessengerEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    function index()
    {
        $senderId = auth()->user()->id;
        $chatUsers = Chat::with('receiver')
            ->select('receiver_id')
            ->where('receiver_id', '!=', $senderId)
            ->where('sender_id', $senderId)
            ->groupBy('receiver_id')
            ->get();
        return view('frontend.dashboard.messenger.index', compact('chatUsers'));
    }

    function SendMessageFromProductPage(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required'],
            'message' => ['required', 'max:500'],
        ]);
        $chat = new Chat();
        $chat->sender_id = auth()->user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();
        return response(['status' => 'success', 'message' => 'Message Sent Successfully !'], 200);
    }

    function FetchUserChat(Request $request)
    {
        $senderId = auth()->user()->id; // Current logged-in user ID
        $receiverId = $request->receiverID; // Selected chat receiver ID

        // Fetch messages exchanged between the authenticated user and the receiver
        $chat = Chat::with('receiver')
            ->where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $senderId)
                    ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
            Chat::where(['sender_id'=>$receiverId,'receiver_id'=>$senderId])->update(['status'=>1]);
        return response(['status' => 'success', 'chat' => $chat, 'receiverName' => $chat[0]->receiver->name,'receiverImage' => $chat[0]->receiver->image], 200);
    }


    function SendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required'],
            'message' => ['required', 'max:500'],
        ]);
        $chat = new Chat();
        $chat->sender_id = auth()->user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();
        broadcast(new MessengerEvent($chat))->toOthers();
        return response($chat);
    }
}
