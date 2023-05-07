<?php

namespace App\Http\Controllers;

use DB;
use Flash;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:permissions-index|permissions-create|permissions-edit|permissions-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permissions-create', ['only' => ['create','store']]);
         $this->middleware('permission:permissions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('user.permissionIndex',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.permissionCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->created_at = date('Y-m-d h:i:s');
        $permission->save();

        Flash::success('Permission created successfully.');
        
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
    
        return view('user.permissionShow',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
    
        return view('user.permissionEdit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->guard_name = $request->input('guard_name');
        $permission->save();
        
        Flash::success('Permission updated successfully.');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        Flash::success('Permission deleted successfully.');
        return redirect()->route('permissions.index');
    }
}
