<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\AppVersion;
use Illuminate\Http\Request;

class AppVersionController extends Controller
{
    public function appVersion(){
        $version = AppVersion::select('android_version','ios_version')->latest()->first();
        return response()->json(['success'=>true,'response'=> $version], 200);
    }
    public function appVersionUpdate(Request $request){
        $version = AppVersion::latest()->first();
        if (empty($version)){
            $version = new AppVersion();
        }
        $version->android_version = $request->android_version;
        $version->ios_version = $request->ios_version;
        $version->save();
        $successData = AppVersion::select('android_version','ios_version')->latest()->first();
        return response()->json(['success'=>true,'response'=> $successData], 200);
    }
    public function deleteAccount(){
        $user = Auth::user();
        $user->delete();
        return response()->json(['success'=>true,'response'=> 'Account deleted successfully'], 200);
    }
}
