<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        $user_det = User::get();
        //user count
        $userCount = User::count();
        return view('admin.index', compact('user_det', 'userCount'));
    }
    //delete user delete_user

    public function delete_user(Request $request)
    {
        try {
            $user_det = User::get();
            //user count
            $userCount = User::count();
            $user_id = $request->id;
            $user = User::where('id', $user_id)->firstOrFail();
            $user->delete();
            return redirect()->route('admin.dashboard', compact('user_det', 'userCount'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user');
        }
    }
}
