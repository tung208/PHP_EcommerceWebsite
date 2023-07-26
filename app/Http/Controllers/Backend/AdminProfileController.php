<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{

    public function adminProfile(){
       $adminData= Admin::find(1);
       return view('admin.admin_profile_view',compact('adminData'));
    }

    public function adminProfileEdit(){
        $editData= Admin::find(1);
        return view('admin.admin_profile_edit',compact('editData'));
    }
    public function adminProfileUpdate(Request $request){
        $data = Admin::find(1);
        $data-> name = $request-> name;
        $data-> email = $request-> email;
        if($request-> file('profile_photo_path')){
            $file= $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data-> profile_photo_path));
            $saveUrl= date('YmdHi').$file->getClientOriginalName();
            $file -> move(public_path('upload/admin_images'),$saveUrl);
            $data-> profile_photo_path = $saveUrl;
        }
        $data-> save();

        $notification = array(
            'message' => 'Admin Profile Update Successfully',
            'alert-type' => 'success'


        );


        return redirect()-> route('admin.profile')-> with($notification);
    }
    public function adminChangePassword(){
        return view('admin.admin_change_password');
    }
    public function adminUpdatePassword(Request $request){

        $validateData = $request-> validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required | same:newpassword'
        ],[
                'oldpassword.required' => 'Old Password is required',
                'newpassword.required' => 'New Password is required',
                'confirm_password.required' => 'Confirm_password is required '
            ]
        );
        $hashedPassword = Admin::find(1)-> password;
        if(Hash::check($request-> oldpassword,$hashedPassword)){
            $admin = Admin::find(1);
            $admin -> password = Hash::make($request->newpassword);
            $admin-> save();
            $notification = array(
                'message' => 'Admin Password Update Success',
                'alert-type' => 'success'

            );
            Auth::logout();
            return redirect()-> route('admin.logout')-> with($notification);
        }else{
            $notification = array(
                'message' => 'Admin Password Update Fail',
                'alert-type' => 'error'

            );
            return redirect()-> back()-> with($notification);
        }

    }
}
