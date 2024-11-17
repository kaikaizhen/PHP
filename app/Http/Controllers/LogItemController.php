<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogItem;

class LogItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('LogItem.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'Date'=>'required|date_format:H:i',
            'Number'=>'required|integer',
            'Title'=>'required|string',
            'description'=>'required|string',
            'image_url'=>'required|string'
        ]);
        $id = $validatedData['Number'];
        LogItem::create($request->all());
        return redirect()->route('logitem.show', $id)->with('msg', '儲存成功~');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $logItems = LogItem::where('Number', $id)->get();
        return view('LogItem.index',compact('logItems','id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogItem $logitem)
    {
        return view('LogItem.edit',compact('logitem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogItem $logitem)
    {

        $validatedData =$request->validate([
            'Date'=>'required|date_format:H:i',
            'Number'=>'required|integer',
            'Title'=>'required|string',
            'description'=>'required|string',
            'image_url'=>'required|string'
        ]);
        $id = $validatedData['Number'];
        $logitem->update($request->all());
        return redirect()->route('logitem.show', $id)->with('msg', '儲存成功~');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogItem $logitem)
    {
        $logitem->delete();
        return back()->with('msg', '刪除成功');
    }
}
