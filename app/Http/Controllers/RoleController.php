<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(20);
        return view('roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 20);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        return redirect()->route('roles.index')->with('success','Role created successfully');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        return redirect()->route('roles.index')->with('success','Role updated successfully');
    }
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success','Role deleted successfully');
    }
}
