<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\EF;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Sites=Site::all();

        $EFs=EF::all();

        return view('Site.index',compact('Sites','EFs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Site.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type=$request->input('Type');

        if($type==='環保'){
            $request->merge(['Class' => 'fa-solid fa-seedling']);
        }elseif($type === '文教'){
            $request->merge(['Class' => 'fa-solid fa-book']);
        }elseif($type === '讀書會與講座'){
            $request->merge(['Class' => 'fa-solid fa-chalkboard-user']);
        }elseif($type === '社區慈善'){
            $request->merge(['Class' => 'fa-solid fa-person']);
        }elseif($type === '節慶活動'){
            $request->merge(['Class' => 'fa-regular fa-calendar']);
        }

        $request->validate([
            'Type' => 'required|string|max:50',
            'Class' => 'required|string|max:50',
            'Name' => 'required|string|max:50',
            'Site' => 'required|string|max:50',
            'Lat' => 'required|numeric|between:-9999999.9999999,9999999.9999999',
            'Lng' => 'required|numeric|between:-9999999.9999999,9999999.9999999',
            'Description' => 'nullable|string',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate'
        ]);

        Site::create($request -> all());
        return redirect() ->route('Site.index')->with('msg','儲存成功');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $Site)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $Site)
    {
        return view('Site.edit',compact('Site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $Site)
    {
        $type=$request->input('Type');

        if($type==='環保'){
            $request->merge(['Class' => 'fa-solid fa-seedling']);
        }elseif($type === '文教'){
            $request->merge(['Class' => 'fa-solid fa-book']);
        }elseif($type === '讀書會與講座'){
            $request->merge(['Class' => 'fa-solid fa-chalkboard-user']);
        }elseif($type === '社區慈善'){
            $request->merge(['Class' => 'fa-solid fa-person']);
        }elseif($type === '節慶活動'){
            $request->merge(['Class' => 'fa-regular fa-calendar']);
        }

        $request->validate([
            'Type' => 'required|string|max:50',
            'Class' => 'required|string|max:50',
            'Name' => 'required|string|max:50',
            'Site' => 'required|string|max:50',
            'Lat' => 'required|numeric|between:-9999999.9999999,9999999.9999999',
            'Lng' => 'required|numeric|between:-9999999.9999999,9999999.9999999',
            'Description' => 'nullable|string',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate'
        ]);

        $Site->update($request ->all());
        return redirect() ->route('Site.index')->with('msg','變更成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $Site)
    {
        $Site->delete();
        return redirect() ->route('Site.index')->with('msg','刪除成功');
    }
}
