<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use App\Models\Message;
use App\Models\User;
class MessageController extends Controller
{
    public function broadcast(Request $request) {
        if (! $request->filled('message')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }
        $message = new Message;

        $message->user = Auth::user()->id;
        $message->message = $request->message;
        $message->save();
        event(new NewChatMessage($request->message, $request->user));

        return response()->json([], 200);

    }
    public function getMessages()
    {
        $dbMessages = Message::latest()->take(50)->get();
        $messages = [];
        foreach($dbMessages as $message){
            $messages[] = [
                "user"=>User::where('id',$message->user)->first()->name,
                "text"=>$message->message];
        }
        return response()->json($messages , 200);
    }
}
