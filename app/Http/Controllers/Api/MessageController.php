<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function get_messages()
    {
        $messages = Message::orderBy('id', 'desc')->get();


        return response()->json([
            'messages' => $messages
        ], 200);
    }

    public function update_status(Request $request, $id){
        $message = Message::find($id);

        $message->status = $request->status;
        $message->save();

        return response()->json([
            'status' => $message,
            'message' => 'Status mis a jour'
        ], 200);

    }

    public function delete_message($id){
        $message = Message::find($id);
        $message->delete();
    }
}
