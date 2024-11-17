<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Log;
use App\Models\LogItem;
use App\Models\EF;

class Controller
{
    //地圖地標抓取
    public function Map(){
        $currentTime = date('Y-m-d H:i:s');
        $Site=Site::where('EndDate','>',$currentTime)->get();
        if($Site->isEmpty()){
            return response()->json(['message'=>'Not found'],404);
        }
        return response()->json($Site);
    }

    //地圖環保資料抓取
    public function MapEF(){
        $EF=EF::all();
        if($EF->isEmpty()){
            return response()->json(['message'=>'Not found'],404);
        }
        return response()->json($EF);
    }

    //日誌總覽抓取
    public function GetLog(){
        $items=Log::all();
        if($items->isEmpty()){
            return response()->json(['message'=>'查無事件'],404);
        }
        return response()->json($items);
    }

    //日誌詳細抓取
    public function GetLogItem($id){
        if(!is_numeric($id)){
            return response()->json(['message' => 'Invalid ID'], 400);
        }
        $items = LogItem::where('Number', $id)->get();
        if($items->isEmpty()){
            return response()->json(['message'=>'Not found'],404);
        }

        return response()->json($items);
    }


    //回收率即時存檔
    public function SaveEF(Request $request){
        $request->validate([
            'id'=>'required|integer',
            'gen_recyclable_weight' => 'required|numeric|between:0,99999.99',
            'rec_recyclable_weight' => 'required|numeric|between:0,99999.99',
            'gen_food_waste_weight' => 'required|numeric|between:0,99999.99',
            'rec_food_waste_weight' => 'required|numeric|between:0,99999.99',
            'gen_general_waste_weight' => 'required|numeric|between:0,99999.99',
            'rec_general_waste_weight' => 'required|numeric|between:0,99999.99',
            'gen_hazardous_weight' => 'required|numeric|between:0,99999.99',
            'rec_hazardous_weight' => 'required|numeric|between:0,99999.99',
            'collection_date' => 'required|date',
        ]);
        try{
            EF::create($request->all());
            return response()->json(['msg'=>'儲存成功'],201);
        }
        catch(Exception $e){
            return response()->json(['message' => '儲存失敗', 'error' => $e->getMessage()],404);
        }
    }

    //回收率即時更新
    public function EditEF(Request $request,string $id){
        $request->validate([
            'gen_recyclable_weight' => 'required|numeric|between:0,99999.99',
            'rec_recyclable_weight' => 'required|numeric|between:0,99999.99',
            'gen_food_waste_weight' => 'required|numeric|between:0,99999.99',
            'rec_food_waste_weight' => 'required|numeric|between:0,99999.99',
            'gen_general_waste_weight' => 'required|numeric|between:0,99999.99',
            'rec_general_waste_weight' => 'required|numeric|between:0,99999.99',
            'gen_hazardous_weight' => 'required|numeric|between:0,99999.99',
            'rec_hazardous_weight' => 'required|numeric|between:0,99999.99',
            'collection_date' => 'required|date',
        ]);
        $data = EF::where('id', $id)->first();
        if (!$data) {
            return response()->json(['message' => '未找到該記錄'], 404);
        }
        
        $data->update($request->all());
        
        return response()->json(['msg' => '更新成功'], 200);
    }
}
