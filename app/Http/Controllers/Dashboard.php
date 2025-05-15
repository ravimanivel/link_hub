<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Link;
use App\Models\User;

class Dashboard extends Controller
{
    public function homepage()
    {

        $user_name = session('user');
        $user_email = session('use_email');
        $totalLinks = Link::where('username', $user_name)->count();
        $totalViews  = User::where('username', $user_name)->get();
        $mostClicked = Link::where('username', $user_name)->orderBy('views', 'desc')->take(5)->get();
        $lin_det = Link::where('username', $user_name)->get();

        return view('dashboard.index', compact('totalLinks', 'totalViews', 'mostClicked','user_name', 'lin_det'));
    }

    public function create_link()
    {
        $user_email = session('user');
        $lin_det = Link::where('username', $user_email)->get();
        return view('dashboard.create', compact('user_email', 'lin_det'));
    }
    public function store_link(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'link_description' => '',
            'link_images' => '',
            'link_created_by' => 'required',
            'link_title' => 'required'
        ]);

        try {
            //why the hell is this not working
            $link = new Link();
            $link->link = $request->input('link');
            $link->link_description = $request->input('link_description');
            $link->link_images = $request->input('link_images');
            $link->link_title = $request->input('link_title');
            $link->username = $request->input('link_created_by');
            $link->save();

            return redirect()->route('links.create')->with('message', 'Link Uploaded Successfully !!!');
        } catch (\Exception $e) {
            echo $e;
            exit;
            return redirect()->route('links.create')->with('message', 'Upload Failed');
        }
    }
    public function profile(Request $request)
    {
        $user_email = session('use_email');
        $profile_det = User::where('email', $user_email)->get();

        return view('dashboard.profile', compact('user_email', 'profile_det'));
    }
    public function view_link(Request $request)
    {
        $user_email = $request->username;
        $user_det = User::where('username', $user_email)->get();
        $link_det = Link::where('username', $user_email)->get();
        return view('dashboard.view', compact('user_email', 'link_det', 'user_det'));
    }
    public function view_count(Request $request)
    {
        $user_name = $request->username;
        $run = User::where('username', $user_name)
            ->update(['views' => DB::raw('views + 1')]);
        if ($run) {
            return response()->json(['status' => 'success', 'message' => 'View count updated successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'View count updated failed', 'err', 'error']);
        }
    }
    public function link_view_count(Request $request)
    {
        $user_name = $request->username;
        $view_id = $request->id;
        $run = Link::where('username', $user_name)
            ->where('id', $view_id)
            ->update(['views' => DB::raw('views + 1')]);

        if ($run) {
            return response()->json(['status' => 'success', 'message' => 'View link updated successfully',$run]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'View link updated failed', 'err', $run, $user_name, $view_id]);
        }
    }
    public function delete_link(Request $request)
    {
        $user_email = session('user');

        try {
            $link = Link::where('id', $request->id)
                ->where('username', $user_email)
                ->firstOrFail();

            $link->delete();

            return redirect()->back()->with('message', 'Link deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete link');
        }
    }
}
