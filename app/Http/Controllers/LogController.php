<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log; /*載入模型*/

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Logs=Log::all(); //讀取所有資料
        return view('Log.index',compact('Logs')); //傳送到log/index 內容為Log查詢資料
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Log.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Type'=> 'required|string',
            'Date'=> 'required|date',
            'Title'=>'required|string',
            'description'=>'required|string',
            'image_url'=>'required|string'
        ]);

        Log::create($request->all());
        return redirect()->route('log.index')->with('success','儲存成功~');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Log.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
       return view('Log.edit',compact('log'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        $request->validate([
            'Type'=> 'required|string',
            'Date'=> 'required|date',
            'Title'=>'required|string',
            'description'=>'required|string',
            'image_url'=>'required|string'
        ]);

        $log->update($request->all());
        return redirect()->route('log.index')->with('success','更新成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        $log->delete();
        return redirect()->route('log.index')->with('success','刪除成功');
    }
}
