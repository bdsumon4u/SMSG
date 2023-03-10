<?php

namespace App\Http\Controllers\Api;

use App\Events\DeviceConnected;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\Api\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();
        $token = Str::before($data['scan_data'], 'HOST');

        try {
            auth()->login($user = User::findOrFail(decrypt($token)));
            $device = $user->devices()->firstOrCreate($request->only('device_id'), $data);

            DeviceConnected::dispatch($device);

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Login Successfully',
                'data' => $this->response(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => 'Internal Server Error',
                'errors' => [$e->getMessage()],
            ]);
        }
    }
}
