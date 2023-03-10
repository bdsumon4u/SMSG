<?php

namespace App\Http\Controllers\Api;

use App\Events\DeviceDisconnected;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validated(['device_id' => 'required']);
        $request->user()->tokens()->where(['name' => $data['device_id']])->delete();
        $request->user()->devices()->where($request->only('device_id'))->update(['is_connected' => false]);

        DeviceDisconnected::dispatch($data['device_id']);

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Logout Successfully',
        ]);
    }
}
