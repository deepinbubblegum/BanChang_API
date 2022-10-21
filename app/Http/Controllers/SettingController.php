<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $sensor_api = $request->sensor_api;


        try {
            //$list_value = [$sensor_api];
            //$list_field = ['data_api'];
            //for ($i = 0; $i < 4; $i++) {
                DB::table('setting')->where('name', 'data_api')->update(['value' => $sensor_api]);
            //}

            return response()->json(['success' => true, 'message' => 'Update Successfully']);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }
    public function getlist()
    {
        $list = DB::table('setting')->get();
        $list_data = [];
        foreach ($list as $key => $value) {
            $data[$value->name] = $value->value;
            $list_data = $data;
        }
        return $list_data;

    }
    public function get_sensor()
    {
        $list_field = ['data_api'];
        for ($i = 0; $i < count($list_field); $i++) {
            $data[] = DB::table('setting')->where('name', $list_field[$i])->first();
        }
        $list_data = [];
        foreach ($data as $key => $value) {
            $data2[$value->name] = $value->value;
            $list_data = $data2;
        }
        return $list_data;
    }
}
