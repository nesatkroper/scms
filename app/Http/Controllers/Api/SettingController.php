<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return SettingResource::collection(Setting::paginate(10));
    }

    public function store(StoreSettingRequest $request)
    {
        $setting = Setting::create($request->validated());
        return new SettingResource($setting);
    }

    public function show(Setting $setting)
    {
        return new SettingResource($setting);
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());
        return new SettingResource($setting);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return response()->json(['message' => 'Setting deleted'], 204);
    }
}
