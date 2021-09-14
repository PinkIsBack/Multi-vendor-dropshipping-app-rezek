<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function merchant(Request $request){
        $data = User::role('Merchant')->orderBy('id','DESC')->paginate(20);
        $roles = Role::pluck('name','name')->all();
        return view('users.merchant',compact('data', 'roles'))->with('i', ($request->input('page', 1) - 1) * 20);
    }
    public function supplier(Request $request){
        $data = User::role('Supplier')->orderBy('id','DESC')->paginate(20);
        $roles = Role::pluck('name','name')->all();
        return view('users.supplier',compact('data', 'roles'))->with('i', ($request->input('page', 1) - 1) * 20);
    }
    public function index(Request $request)
    {
        $data = User::role('Admin')->orderBy('id','DESC')->paginate(20);
        $roles = Role::pluck('name','name')->all();
        return view('users.index',compact('data', 'roles'))->with('i', ($request->input('page', 1) - 1) * 20);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
    public function profile(){
        $user = Auth::user();
        return view('users.profile')->with([
            'user'=>$user
        ]);
    }
    public function profileUpdate(Request $request, $id){
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path() . '/images/profile/', $file_name);
            $profile_img = '/images/profile/'. $file_name;
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->business_name = $request->business_name;
        $user->phone = $request->phone;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->country = $request->country;
        if (isset($file_name)){
            $user->profile_img = '/images/profile/'.$file_name;
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile Updated !');
    }
}
