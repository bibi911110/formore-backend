<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Flash;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use FontLib\Font;
use Illuminate\Validation\Rule;

class AclController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:users-index|users-create|users-edit|users-delete', ['only' => ['index','store']]);
        $this->middleware('permission:users-create', ['only' => ['create','store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       // echo Auth::user()->id; exit;
        if(Auth::user()->role_id == '1'){
             $data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();
        }
        elseif(Auth::user()->role_id == '3')
        {
           $data = User::where('is_admin',1)->where('role_id','5')->where('created_by',Auth::user()->id)->orderBy('id','DESC')->get();  
        }
        return view('user.userIndex',compact('data'));
    }

    public function show_data()
    {
        
       $data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();      
        
        return view('user.userIndex',compact('data'));
    }
    public function buss_user_show_data()
    {
       
        $data = User::leftjoin('brand','users.created_by','brand.id')->where('users.is_admin',1)->where('users.role_id','5')->orderBy('users.id','DESC')->select('users.*','brand.name as brand_name')->get();  
        return view('user.bussUserindex',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function user_export($id)
    {
         $data = User::where('is_admin',1)
                ->where('role_id','4')
                ->where('id',$id)
                ->where('id','!=','1')
                ->orderBy('id','DESC')
                ->first()->toArray();

        $folder_path = '/user_excel/';
        if (!File::exists(public_path()  . $folder_path)) {
            File::makeDirectory(public_path() .  $folder_path, 0777, true);
        }
        $uniqid = uniqid().'-'.$data['name'];
        Excel::store(new UserExport($data), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start();

        // Flash::success('Excel is created..please click to download excel.., <a href="'. url('user_export_download' . '/' . $uniqid . '.xlsx') . '"> Download Excel  </a> ');

          Flash::success('Excel is created..please click to download excel.., <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

         $data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();      
        
        return view('user.userIndex',compact('data'));
    }

    public function user_export_report($id)
    {
         $data = User::where('is_admin',1)
                ->where('role_id','4')
                ->where('id',$id)
                ->where('id','!=','1')
                ->orderBy('id','DESC')
                ->first()->toArray();

        $folder_path = '/user_excel/';
        if (!File::exists(public_path()  . $folder_path)) {
            File::makeDirectory(public_path() .  $folder_path, 0777, true);
        }
        $uniqid = uniqid().'-'.$data['name'];
        Excel::store(new UserExport($data), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start();

        // Flash::success('Excel is created..please click to download excel.., <a href="'. url('user_export_download' . '/' . $uniqid . '.xlsx') . '"> Download Excel  </a> ');

          Flash::success('Excel is created..please click to download excel.., <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

        // $data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();      
        
        return view('report.user_report');
          
          //return redirect()->url('user_report');
    }
    
    public function user_export_download($id)
    {
        
        $file_path_full =base_path()."/public/excel/user_excel/".$id;
        
        $file_path =pathinfo(base_path()."/public/excel/user_excel/".$id);
        $basename = $id;
        $path = $id;
    return response()->download($file_path_full, $basename, ['Content-Type' => 'application/force-download']);
    }
    public function create(Request $request)
    {
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        $roles = Role::where('id',5)->pluck('name','name')->all();
        return view('user.userCreate',compact('roles','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'business_id' => 'required',
            //'is_admin' => 'required'
        ]);
        
        $user_d= User::where('userDetailsId',$request->business_id)->where('role_id','3')->select('id')->first();
        $input = $request->all();
        $input['role_id'] =5;
        $input['created_by'] = $request->business_id;
        $input['business_id'] = $user_d->id;
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole(5);
        //$user->assignRole($request->input('5'));
        Flash::success('User created successfully.');
        return redirect()->route('bussUserindex');
    }

    public function buss_user_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|same:confirm-password',
            'business_id' => 'required',
            //'is_admin' => 'required'
        ]);
        
            $user_d= User::where('userDetailsId',$request->business_id)->where('role_id','3')->select('id')->first();
        /*echo "<pre>";
        print_r($user_d); exit;*/
        $input = $request->all();
        $input['role_id'] =5;
        $input['created_by'] = $request->business_id;
        $input['business_id'] = $user_d->id;
        $input['show_password'] = $input['password'];
        $input['password'] = Hash::make($input['password']);
         /*echo "<pre>";
        print_r($input); exit;*/
        $user = User::create($input);
        $user->assignRole(5);
        //$user->assignRole($request->input('5'));
        Flash::success('User created successfully.');
        return redirect()->route('buss_user_show_data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.userShow',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('user.userEdit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['show_password'] = $input['password'];
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
        Flash::success('User updated successfully.');
        return redirect()->route('show_data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Flash::success('User deleted successfully.');
        return redirect()->route('show_data');
    }
    public function users_buss_delete($id)
    {
        User::find($id)->delete();
        Flash::success('User deleted successfully.');
        return redirect()->route('buss_user_show_data');
    }

     public function user_status($id, $status)
    {

        $user =  User::find($id);

        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('show_data'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $user = User::where('id',$id)->update($data, $id);

        Flash::success('user status updated successfully.');

        return redirect(route('show_data'));
    }
}
