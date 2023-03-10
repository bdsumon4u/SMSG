<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Batch;
use App\Models\Message;
use App\Models\User;
use App\Tables\Messages;
use ProtoneMedia\Splade\Facades\Toast;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('messages.index', [
            'messages' => Messages::build(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $devices = (fn (): User => auth()->user())()->devices()->isConnected()->get();

        return view('messages.create', [
            'devices' => $devices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();

        $body = strip_tags($data['body']);
        $batch_id = Batch::create();
        $slots = $request->slots();

        foreach (explode(',', $request->number) as $number) {
            Message::create($data + [
                'batch_id'           => $batch_id,
                'device_id'          => $data['device_id'],
                'device_slot_number' => $slots['number'],
                'device_slot_name'   => $slots['name'],
                'number'             => $number,
                'body'               => $body,
            ]);
        }

        Toast::success('Message is being sent to the device(s)');

        return redirect()->action([static::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
