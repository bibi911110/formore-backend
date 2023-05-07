<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
	public function index(Request $request){
		$user = User::where('id',$request->id)->first();
		return view('user.profileShow',compact('user'));
	}

	public function update(Request $request){
		/*$this->validate($request,
			[
				'name'=>'required',
				'email'=>'required|email'
			],
			[
				'name.required' => 'Please Enter Your Name',
				'email.required' => 'Please Enter Your Email',
				'email.email' => 'Please Enter Email In Valid Format'
			]
		);
*/
		$input = $request->all();

		if (!empty($request->password)) {
			$input['password'] = $input['password'];
		}else{
			$input['password'] = $input['old_pwd'];
		}

		$user = User::find($input['id']);
		if(isset($input['name'])){ $user->name = $input['name']; }
        if(isset($input['email'])){ $user->email = $input['email']; }
        $user->password = Hash::make($input['password']);
        $user->show_password = $input['password'];

        $user->updated_at = date('Y-m-d h:i:s');
        $user->save();

       if($request->password != ''){
       	     Auth::logout();
	        Session::flush();

	    	return redirect('/login')->with('message', 'Your Information Successfully Changed Please Login Again');
    		}else{
    			return back();
    		}
	}
}
