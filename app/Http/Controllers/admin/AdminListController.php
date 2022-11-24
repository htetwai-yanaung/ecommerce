<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminListController extends Controller
{
    //Direct admin list page
    public function adminListPage()
    {
        $list = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'LIKE', '%' . request('key') . '%')
                ->orWhere('email', 'LIKE', '%' . request('key') . '%')
                ->orWhere('address', 'LIKE', '%' . request('key') . '%')
                ->orWhere('phone', 'LIKE', '%' . request('key') . '%');
        })->where('role', 'admin')->get();
        return view('admin.adminList.adminList', compact('list'));
    }

    //Delete admin account
    public function listDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account delete success.']);
    }

    //Direct edit page
    public function editPage($id)
    {
        $adminData = User::where('id', $id)->first();
        return view('admin.adminList.adminDetails', compact('adminData'));
    }

    //Update admin account
    public function updateAdminAccount(Request $request)
    {
        $this->checkAdminValidation($request);

        $dbImage = $request->dbImage;
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'role' => $request->role,
        ];

        if ($request->file('image') != null) {
            File::delete(public_path() . '/storage/image/' . $dbImage);
            $newImage = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/storage/image', $newImage);
            $updateData['image'] = $newImage;
            User::where('id', $request->id)->update($updateData);
        }
        User::where('id', $request->id)->update($updateData);
        return redirect()->route('admin#listPage')->with(['updateSuccess' => 'Account update success']);
    }

    //User List page
    public function userListPage()
    {
        $user = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'LIKE', '%' . request('key') . '%')
                ->orWhere('email', 'LIKE', '%' . request('key') . '%')
                ->orWhere('address', 'LIKE', '%' . request('key') . '%')
                ->orWhere('phone', 'LIKE', '%' . request('key') . '%');
        })->where('role', 'user')->get();
        return view('admin.userList.userList', compact('user'));
    }

    //Direct change password page
    public function changePasswordPage()
    {
        return view('admin.changePassword');
    }

    //Change Password
    public function changePassword(Request $request)
    {
        $this->checkPasswordValidation($request);
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $DBoldPassword = User::where('id', Auth::user()->id)->first();
        $DBoldPassword = $DBoldPassword['password'];

        if (Hash::check($oldPassword, $DBoldPassword)) {
            $data = [
                'password' => Hash::make($newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);

            Auth::logout();
            return redirect('/loginPage');
            // return back()->with(['successMessage' => 'Password change success']);
        } else {
            return back()->with(['errorMessage' => 'Wrong old password. Try again!']);
        }
    }



    //Check admin validation
    private function checkAdminValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'address' => 'required'
        ])->validate();
    }

    //Check change password
    private function checkPasswordValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ])->validate();
    }
}