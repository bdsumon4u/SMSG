<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PusherController extends Controller
{
    public function __invoke(Request $request, ?string $socketId, ?string $channelName): Response
    {
        $socketId = $request->get('socketId', $socketId);
        $channelName = $request->get('channelName', $channelName);
        $secret = config('broadcasting.connections.pusher.secret');
        $hash = hash_hmac('sha256', $socketId.':'.$channelName, $secret);

        return response([
            'success' => true,
            'message' => 'Pusher authentication successfull.',
            'auth' => config('broadcasting.connections.pusher.key').':'.$hash,
        ]);
    }
}
