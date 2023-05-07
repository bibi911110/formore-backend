<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TridentInfowayManagementModel;

class TridentInfowayManagementController extends Controller
{
	public function index(){
		return view('user.TridentInfowayIndex');		
	}

	public function login_data(Request $request){
		$input = $request->all();

		$userdata = TridentInfowayManagementModel::where('username',md5($input['username']))
													->where('password',md5($input['password']))
													->first();
		if ($userdata) {
			$request->session()->put('trident_status', '1');
			return response()->json(['message' => 'Username And Password Are Match','status' => 1]);
		}else{
			return response()->json(['message' => 'Wrong Username And Password','status' => 0]);
		}
	}

	public function logout_data(Request $request){
		$request->session()->forget('trident_status');
		return redirect('Trident-Infoway-Management');	
	}
}
