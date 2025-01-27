<?php

namespace App\Http\Controllers;

use App\Models\AiMessage;
use Illuminate\Http\Request;

class AiMessageController extends Controller
{
    public function index()
    {
        $messages = AiMessage::latest()->paginate(10);
        return view('admin.ai-messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string|max:20',
            'client_question' => 'required|string',
            'ai_response' => 'required|string',
        ]);

        $validated['message_date'] = now();

        $aiMessage = AiMessage::create($validated);

        return response()->json($aiMessage, 201);
    }

    public function show(AiMessage $aiMessage)
    {
        $message = $aiMessage;
        return view('admin.ai-messages.show', compact('message'));
    }

    public function destroy(AiMessage $aiMessage)
    {
        $aiMessage->delete();
        return redirect()->route('admin.ai-messages.index')
            ->with('success', 'تم حذف الرسالة بنجاح');
    }

    // API method to store AI messages
    public function apiStore(Request $request)
    {
        return $this->store($request);
    }
}
