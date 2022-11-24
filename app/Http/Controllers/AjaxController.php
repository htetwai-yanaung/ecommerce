<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function changeAdminRole()
    {
        $id = request('id');
        $data = User::where('id', $id)->first();
        $role = $data->role;
        if ($role == 'user') {
            User::where('id', $id)->update([
                'role' => 'admin'
            ]);
        } else {
            User::where('id', $id)->update([
                'role' => 'user'
            ]);
        }
    }
}