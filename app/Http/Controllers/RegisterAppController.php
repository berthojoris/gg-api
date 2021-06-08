<?php

namespace App\Http\Controllers;

use App\Models\RegisterApp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\RegisteredAppRequest;

class RegisterAppController extends Controller
{
    public function registerapp(RegisteredAppRequest $request)
    {
        $newParam = Str::uuid();
        $request->request->add(['uuid' => $newParam]);

        $registerApp = RegisterApp::create($request->all());

        return [
            'data' => [
                'app_uuid' => $registerApp->uuid
            ],
            'message' => 'Developer request created'
        ];
    }

    public function approved(Request $request)
    {
        $findData = RegisterApp::where('uuid', $request->app_uuid)->first();

        if(empty($findData)) {
            return response()->json([
                'message' => 'Developer app not found'
            ], 404);
        }

        $findData->update([
            'status' => 'APPROVED'
        ]);

        return response()->json([
            'message' => $findData->app_name.' has been approved'
        ], 200);
    }

    public function rejected(Request $request)
    {
        $findData = RegisterApp::where('uuid', $request->app_uuid)->first();

        if(empty($findData)) {
            return response()->json([
                'message' => 'Developer app not found'
            ], 404);
        }

        $findData->update([
            'status' => 'REJECTED'
        ]);

        return response()->json([
            'message' => $findData->app_name.' has been rejected'
        ], 200);
    }
}
