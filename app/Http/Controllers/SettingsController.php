<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function index()
    {
        return view('settings',['data' => Settings::latest()->first()]);
    }

    public function update(UpdateSettingsRequest $request)
    {
        $setting = Settings::latest()->first();
        $setting->return_days = $request->return_days;
        $setting->fine = $request->fine;
        $setting->save();
        return redirect()->route('settings');
    }

}
