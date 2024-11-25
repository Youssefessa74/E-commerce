<?php

namespace App\Http\Controllers\Backend;

use App\Events\MessengerEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class VendorMessengerController extends Controller
{
    function index(){
        $senderId = auth()->user()->id;
        $chatUsers = Chat::with('sender')
        ->select('sender_id')
        ->where('receiver_id',$senderId)
        ->where('sender_id','!=',$senderId)
        ->groupBy('sender_id')
        ->get();
        return view('vendor.messenger.index',compact('chatUsers'));
    }
    function FetchUserChat(Request $request) {
        $receiverId = auth()->user()->id; // Current logged-in user ID
        $senderId = $request->senderID; // Selected chat receiver ID

        // Fetch messages exchanged between the authenticated user and the receiver
        $chat = Chat::with('sender')
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
            Chat::where(['sender_id'=>$senderId,'receiver_id'=>$receiverId])->update(['status'=>1]);
        return response(['status'=>'success','chat'=>$chat,'senderName'=>$chat[0]->sender->name,'senderImage'=>$chat[0]->sender->image],200);
    }

    function SendMessage(Request $request) {
        $request->validate([
            'receiver_id' => ['required'],
            'message' =>['required','max:500'],
           ]);
           $chat = new Chat();
           $chat->sender_id = auth()->user()->id;
           $chat->receiver_id = $request->receiver_id;
           $chat->message = $request->message ;
           $chat->save();
           broadcast(new MessengerEvent($chat))->toOthers();
        return response($chat);
    }

}
