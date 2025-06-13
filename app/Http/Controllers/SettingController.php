<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $setting = Setting::all();
            if ($setting->count() == 0)
                return response()->json(['msg', 'Empty item'], 400);
            else
                return response()->json(['msg' => true, 'data' => $setting], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $setting = Setting::create($request->all());
        return response()->json(["msg" => true, "data" => $setting], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
