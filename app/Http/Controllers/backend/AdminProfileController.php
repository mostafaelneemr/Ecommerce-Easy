<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $adminData = admin::find(1);
         return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $editData = admin::find(1);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $data = admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdateChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = admin::find(1)->password;
        if (Hash::check($request->oldpassword, $hashedPassword))
        {
            $admin = admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout'); // this problem in back with route
        }else{
            return  redirect()->back();
        }
    }
}
