<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Flash;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_session_data = DB::table('sessions')->where('user_id',Auth::user()->id)->get();
        return view('user.UserActivity',compact('user_session_data'));
    }

    public function delete_one_data(Request $request)
    {
        DB::table('sessions')->where('id',$request->id)->delete();

        Flash::success('Session deleted successfully.');

        return redirect('/logins');
    }

    public function delete_all_data(Request $request)
    {
        DB::table('sessions')->where('user_id',$request->id)->delete();

        return redirect('/login')->with('message', 'You are successfully destroy your all sessions. Please Login Again');
    }

}
