<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Exports\User_Report_Export;
use App\Exports\Brand_Report_Export;
use App\Exports\Transaction_Report_Export;
use App\Exports\BusinessAdminPerformanceExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $member_count = User::where('role_id','4')->count();
        $lastWeekUsersCount = User::where('role_id','4')->whereDate('created_at', '>=', \Carbon\Carbon::now()->addWeeks(-1))->count();
        $lastMonthUsersCount = User::where('role_id','4')->whereDate('created_at', '>=', \Carbon\Carbon::now()->addMonths(-1))->count();

        $business_count = \App\Models\Brand::where('type','1')->count();
        $brand_count = \App\Models\Brand::where('type','2')->count();
        $total_count = \App\Models\Brand::count();
        $brand = \App\Models\Brand::get();

        $countryArray = [];
        $country = \App\Models\Country::get();
        /*$country = DB::table('country')
            ->join('users', 'country.id', 'users.residence_country_id')
            ->select('country.*', DB::raw("count(users.id) as user_count"))
            ->selectRaw("country.*, COUNT('users.id') as user_count")
            ->groupBy('website_tags.id')
            ->get();
        echo "<pre>";
        print_r($country);
        exit;*/
        foreach ($country as  $countryData) {
            $all = \App\User::where('residence_country_id',$countryData->id)->count();
            $today = \App\User::where('residence_country_id',$countryData->id)->whereDate('created_at', '>=', \Carbon\Carbon::now())->count();
            
            $currentMonth = \App\User::where('residence_country_id',$countryData->id)->whereMonth('created_at', Carbon::now()->month)->count();

            $countryArray[] = array('country_id' => $countryData->id,'country_code' =>$countryData->country_code,"country_name" => $countryData->country_name,'country_icon' => $countryData->country_icon,'member_count' => $all,'today' => $today,'currentMonth'=>$currentMonth);
        }
        
        $countryFinal = array();
        foreach ($countryArray as $key => $row)
        {
            $countryFinal[$key]['member_count'] = $row['member_count'];
            $countryFinal[$key]['country_id'] = $row['country_id'];
            $countryFinal[$key]['country_code'] = $row['country_code'];
            $countryFinal[$key]['country_name'] = $row['country_name'];
            $countryFinal[$key]['country_icon'] = $row['country_icon'];
            $countryFinal[$key]['today'] = $row['today'];
            $countryFinal[$key]['currentMonth'] = $row['currentMonth'];
        }
        array_multisort($countryFinal, SORT_DESC, $countryArray);

        /*buss login*/
        /*echo "<pre>";
        print_r(Auth::user()->role_id); exit;*/
        if(Auth::user()->role_id == 5)
        {
            $buss_id = \App\User::where('role_id','5')->where('id',Auth::user()->id)->first();
            $buss_user = \App\User::where('role_id','5')->where('business_id',$buss_id->business_id)->count();
            $number_user = \App\Models\My_rewards::where('buss_id',Auth::user()->userDetailsId)->count();
            $total_order = \App\Models\Member_orders::where('created_by',$buss_id->business_id)->count();
            $total_app = \App\Models\Booked_services::where('created_by',$buss_id->business_id)->count();
        }else{

            $buss_user = \App\User::where('role_id','5')->where('business_id',Auth::user()->id)->count();
            $number_user = \App\Models\My_rewards::where('buss_id',Auth::user()->userDetailsId)->count();
            $total_order = \App\Models\Member_orders::where('created_by',Auth::user()->id)->count();
            $total_app = \App\Models\Booked_services::where('created_by',Auth::user()->id)->count();
        }

        
        
        return view('home',compact('member_count','lastWeekUsersCount','lastMonthUsersCount','country','business_count','brand_count','total_count','brand','countryFinal','buss_user','number_user','total_order','total_app'));
    }

    
    public function subcatList( Request $request )
    {
        $idsArr = explode(',',$request->cat_id);

        $sub_cat_data = \App\Models\Sub_category::leftJoin('category','category.id','=','sub_category.cat_id')
        ->whereIn('sub_category.cat_id',$idsArr)
        ->where('sub_category.status', '1')
        ->select(DB::raw("CONCAT(category.name,'-',sub_category.name) AS cat_subcatName"),'sub_category.id')
        ->pluck("cat_subcatName", "sub_category.id");
        
        return response()->json($sub_cat_data);
    }
     public function segmentList(Request $request)
    {
       
        $segmentList = \App\Models\Points_master::leftJoin('brand','points_master.business_id','=','brand.id')
        ->leftJoin('points_segment','points_master.id','=','points_segment.point_id')
        ->leftJoin('segment','points_segment.segments_id','=','segment.id')
        ->where('segment.status', '1')
        ->where('points_master.business_id', $request->buss_id)
        ->pluck("segment.segment_name", "segment.id"); 
        return response()->json($segmentList);
    }

    public function getBusinessPointStamp(Request $request)
    {    
                
         $checkPoint = \App\Models\Brand::select('stamp_point')->where('id',$request->business_id)->first();
        if($checkPoint->stamp_point == 1)
        {
            $checkStamp = 1;
            $checkPoint = 0;
            $level = [];
        }else{
            $checkStamp = 0;
            $checkPoint = 2;
            $level = \App\Models\Points_master::where('business_id',$request->business_id)->select('levels_based_on_scenarios')->first();
            /*echo "<pre>";
            print_r($level); exit;*/

        }
        
        $data = array('point' => $checkPoint,'stamp' => $checkStamp,'level' => $level);
        return response()->json($data);
    }

    public function getBusinessPointDetails(Request $request)
    {    
                
        $checkPoint = \App\Models\Brand::select('stamp_point')->where('id',$request->business_id)->first();
        if($checkPoint->stamp_point == 1)
        {
            $checkStamp = 1;
            $checkPoint = 0;
            //$level = [];
        }else{
            $checkStamp = 0;
            $checkPoint = 2;
            //$level = \App\Models\Points_master::where('business_id',$request->business_id)->select('schema')->first();

        }
        
        $data = array('point' => $checkPoint,'stamp' => $checkStamp);
        return response()->json($data);
    }
     public function buss_countryList(Request $request)
    {
       
       $chec_id = \App\Models\Stamp_master::select('id')->where('business_id',$request->buss_id_country)->exists();

       if(!empty($chec_id) && $chec_id == 1)
       {
            $countryList = \App\Models\Stamp_master::leftJoin('country','stamp_master.country_id','=','country.id')
                                            ->where('stamp_master.business_id',$request->buss_id_country)
                                            ->pluck('country.country_name','country.id');
      
                                            //->first();
           

        }
        else
        {
             $countryList = \App\Models\Points_master::leftJoin('country','points_master.country_id','=','country.id')
                                            ->where('points_master.business_id',$request->buss_id_country)
                                            ->pluck('country.country_name','country.id');
                                           // ->first();
        }
       
        return response()->json($countryList);
    }

    public function get_country_buss_list(Request $request)
    {

        $bussList = \App\Models\Brand::where('type','1')->where('country_id',$request->country_id)->pluck('name','id');
        return response()->json($bussList);
    }

    public function get_country_brand_list(Request $request)
    {
        
        $brandList = \App\Models\Brand::where('type','2')->where('country_id',$request->country_id)->pluck('name','id');
        return response()->json($brandList);
    }
    public function get_days_count_list()
    {

        /*$users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');*/

        $mon_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(8))->count();
        $tu_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(7))->count();
        $wed_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(6))->count();
        $th_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(5))->count();
        $fri_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(4))->count();
        $sat_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(3))->count();
        $sun_count  = User::where('role_id','4')->whereDate('created_at',Carbon::now()->subDays(2))->count();

        $users_count = array('0' => $mon_count,
                             '1' => $tu_count,
                             '2' => $wed_count,
                             '3' => $th_count,
                             '4' => $fri_count,
                             '5' => $sat_count,
                             '6' => $sun_count,
                            );
       /* echo "<pre>";
        print_r($users_count); exit;*/
        // echo $mon_count; exit;

        return response()->json($users_count);
    }

    public function get_month_count_list()
    {
        $users = User::where('role_id','4')->select('id', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            $userArr[$i]['name'] = $month[$i - 1];
            if (!empty($usermcount[$i])) {
                $userArr[$i]['y'] = $usermcount[$i];
            } else {
                $userArr[$i]['y'] = 0;
            }
           //unset($userArr[$i]); 
        }

        //"data" => json_encode($dataPoints),
        /*echo "<pre>";
        print_r(array_values($userArr)); exit;*/
        


    return response()->json(array_values($userArr));
        
       
    }
    
    public function user_report()
    {
        
       //$data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();      
       return view('report.user_report');        
    }

    public function user_report_find(Request $request)
    {
       
    $query = User::query()
            ->leftJoin('language','users.lang_id','language.id')
            ->leftJoin('country','users.residence_country_id','country.id')
            ->where('users.role_id','4')
            ->where('users.id','!=','1')
            ->orderBy('users.id','DESC');
    if(!empty($request->from_date) && $request->from_date != '' && !empty($request->to_date) && $request->to_date != '') {

        $start_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
        //echo $end_date; exit;
        $query = $query->whereBetween('users.created_at', [$start_date, $end_date]);
     }

    if(!empty($request->reg_date) && $request->reg_date != '') {
        $query = $query->whereDate('users.created_at', '=', $request->reg_date);
    }
    if(!empty($request->birth_date) && $request->birth_date != '' ) {
          $query = $query->where('users.birth_date',$request->birth_date);
    }

    if(!empty($request->country_id) && $request->country_id != '' && $request->business == '') {
        //echo "string"; exit;
        if($request->country_id != 'All')
        {
            $query = $query->where('users.residence_country_id',$request->country_id);
        }
    }
    if(!empty($request->business) && $request->business != '') {
        //echo $request->business; exit;
        $query = $query->where('users.user_type','3');
        //$query = $query->where('created_by',$request->business);
    }
    /*if(!empty($request->brand) && $request->brand != '') {
        $query = $query->where('user_type','3');
        $query = $query->where('userDetailsId',$request->brand);
    }*/
    if(!empty($request->marital_status) && $request->marital_status != '') {
        $query = $query->where('users.marital_status',$request->marital_status);
    }
    if(!empty($request->sex) && $request->sex != '') {
        $query = $query->where('users.sex',$request->sex);
    }
    if(!empty($request->no_kids) && $request->no_kids != '') {
        $query = $query->where('users.no_kids',$request->no_kids);
    }
    if(!empty($request->lang_id) && $request->lang_id != '') {
        $query = $query->where('users.lang_id',$request->lang_id);
    }

    if(!empty($request->unique_no) && $request->unique_no != '') {
        $query = $query->where('users.unique_no',$request->unique_no);
    }
    if(!empty($request->entartainment) && $request->entartainment != '') {
        $query = $query->where('users.entartainment',$request->entartainment);
    }
    if(!empty($request->sports) && $request->sports != '') {
        $query = $query->where('users.sports',$request->sports);
    }

    if(!empty($request->technolocgy) && $request->technolocgy != '') {
        $query = $query->where('users.technolocgy',$request->technolocgy);
    }

    if(!empty($request->music) && $request->music != '') {
        $query = $query->where('users.music',$request->music);
    }

    if(!empty($request->travelings) && $request->travelings != '') {
        $query = $query->where('users.travelings',$request->travelings);
    }

    if(!empty($request->electronic_games) && $request->electronic_games != '') {
        $query = $query->where('users.electronic_games',$request->electronic_games);
    }

    if(!empty($request->food) && $request->food != '') {
        $query = $query->where('users.food',$request->food);
    }

    if(!empty($request->nightlife) && $request->nightlife != '') {
        $query = $query->where('users.nightlife',$request->nightlife);
    }

    $query = $query->select('users.*','language.language_name','country.country_name','country.country_code');
    $data = $query->get();
       /* echo "<pre>";
        print_r($data); exit;*/
    if(!empty($data))
    {
        $uniqid = uniqid();
        Excel::store(new User_Report_Export($data),  $uniqid.'.xlsx','excel');
        $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
        $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start(); // and this
        $exce_download_url = url('/').'/public/excel/'.$uniqid.'.xlsx';
        return view('report.user_report',compact('data','basename','exce_download_url')); 
    }else{
        return view('report.user_report',compact('data')); 

    }

       
    }


    public function brand_report()
    {
        
       //$data = User::where('is_admin',1)->where('role_id','4')->where('id','!=','1')->orderBy('id','DESC')->get();      
       return view('report.brand_report');        
    }

    public function brand_report_find(Request $request)
    {
   
    $query = \App\Models\Brand::orderBy('brand.id','DESC')
           ->leftjoin('category','brand.cat_id','category.id')
           ->leftjoin('sub_category','brand.sub_id','sub_category.id')       
           ->leftjoin('country','brand.country_id','country.id');        
    
    if(!empty($request->business) && $request->business != '' && $request->business != '0') {
        $query = $query->where('brand.type','1');
        $query = $query->where('brand.id',$request->business);
    }
    if(!empty($request->brand) && $request->brand != '' && $request->brand != '0') {
        $query = $query->where('brand.type','2');
        $query = $query->where('brand.id',$request->brand);
    }
    if(!empty($request->from_date) && $request->from_date != '' && !empty($request->to_date) && $request->to_date != '') {

        $start_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
        //echo $end_date; exit;
        $query = $query->whereBetween('brand.created_at', [$start_date, $end_date]);
     }

    $query = $query->select('brand.*','category.name as cat_name','sub_category.name as sub_name','country.country_name');
    $data = $query->get();
        /*echo "<pre>";
        print_r($data); exit;*/
    if(!empty($data))
    {
        $uniqid = uniqid();
        Excel::store(new Brand_Report_Export($data),  $uniqid.'.xlsx','excel');
        $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
        $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start(); // and this
        $exce_download_url = url('/').'/public/excel/'.$uniqid.'.xlsx';
        return view('report.brand_report',compact('data','basename','exce_download_url')); 
    }else{

    return view('report.brand_report',compact('data')); 
    }

       
    }

    public function transaction_report()
    {
           return view('report.transaction_report');        
    }

    public function transaction_report_find(Request $request)
    {
   
    $query = \App\Models\Transaction_history::orderBy('transaction_history.id','DESC')
           ->leftjoin('users','transaction_history.user_id','users.id')
           ->leftjoin('brand','transaction_history.buss_id','brand.id')
           ->leftjoin('gift_vocher_types','transaction_history.transaction_type_id','gift_vocher_types.id');        
    
    if(!empty($request->buss_id) && $request->buss_id != '' && $request->buss_id != '0') {
        $query = $query->where('transaction_history.buss_id',$request->buss_id);
    }
    if(!empty($request->brand_id) && $request->brand_id != '' && $request->brand_id != '0') {
        $query = $query->where('transaction_history.buss_id',$request->brand_id);
    }
     if(!empty($request->user_id) && $request->user_id != '' && $request->user_id != '0') {
        $query = $query->where('transaction_history.user_id',$request->user_id);
    }
    if(!empty($request->from_date) && $request->from_date != '' && !empty($request->to_date) && $request->to_date != '') {

        $start_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
        $end_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
        $query = $query->whereBetween('transaction_history.created_at', [$start_date, $end_date]);
     }

    $query = $query->select('transaction_history.*','brand.name as brandName','users.name as username','gift_vocher_types.name as transaction');
    $data = $query->get();
    if(!empty($data))
    {
        $uniqid = uniqid();
        Excel::store(new Transaction_Report_Export($data),  $uniqid.'.xlsx','excel');
        $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
        $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start(); // and this
        $exce_download_url = url('/').'/public/excel/'.$uniqid.'.xlsx';
        return view('report.transaction_report',compact('data','basename','exce_download_url')); 
    }else{

      return view('report.transaction_report',compact('data')); 
    }

       
    }

    public function business_admin_performance(Request $request)
    {

        if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

            $rewardsStamp = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(stamps) as totalStamp')->first();


            $rewardsPoint = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(point_per_stamp) as totalPoint')->first();
            
            $freeVoucher = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',1)
                                ->selectRaw('count(id) as totalFreeVoucher')->first();

            $superDeal = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',2)
                                ->selectRaw('count(id) as totalSuperDeal')->first();

            $superCode = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',3)
                                ->selectRaw('count(id) as totalSuperCode')->first();


            $birthdayCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',2)
                                ->selectRaw('sum(stamps) as totalBirthday')->first();

            $welcomeCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',6)
                                ->selectRaw('sum(stamps) as totalWelcome')->first();
        }
        else
        {
            $fromDate = \Carbon\Carbon::today()->toDateString();
            $toDate = \Carbon\Carbon::today()->toDateString();

            $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

            $rewardsStamp = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(stamps) as totalStamp')->first();


            $rewardsPoint = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(point_per_stamp) as totalPoint')->first();
            
            $freeVoucher = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',1)
                                ->selectRaw('count(id) as totalFreeVoucher')->first();

            $superDeal = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',2)
                                ->selectRaw('count(id) as totalSuperDeal')->first();

            $superCode = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',3)
                                ->selectRaw('count(id) as totalSuperCode')->first();


            $birthdayCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',2)
                                ->selectRaw('sum(stamps) as totalBirthday')->first();

            $welcomeCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',6)
                                ->selectRaw('sum(stamps) as totalWelcome')->first();
        }
        

        
        return view('report.business_admin_performance',compact('rewardsStamp','rewardsPoint','freeVoucher','superDeal','superCode','birthdayCount','welcomeCount','business_details','fromDate','toDate'));
    }

    public function business_admin_performance_export($start_date,$end_date)
    {
        $transactionArray = array();
            if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != '') 
            {
                $fromDate = $request->from_date;
                $toDate = $request->to_date;
                $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

                $rewardsStamp = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(stamps) as totalStamp')->first();


                $rewardsPoint = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(point_per_stamp) as totalPoint')->first();
            
                $freeVoucher = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',1)
                                ->selectRaw('count(id) as totalFreeVoucher')->first();

                $superDeal = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',2)
                                ->selectRaw('count(id) as totalSuperDeal')->first();

                $superCode = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',3)
                                ->selectRaw('count(id) as totalSuperCode')->first();


                $birthdayCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',2)
                                ->selectRaw('sum(stamps) as totalBirthday')->first();

                $welcomeCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',6)
                                ->selectRaw('sum(stamps) as totalWelcome')->first();
            }
            else
            {
                $fromDate = Carbon::today()->toDateString();
                $toDate = Carbon::today()->toDateString();
                $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

                $rewardsStamp = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(stamps) as totalStamp')->first();


                $rewardsPoint = \App\Models\My_rewards::where('buss_id',Auth::user()->id)
                        ->whereDate('created_at','>=', $fromDate)
                        ->whereDate('created_at','<=', $toDate)
                        ->selectRaw('sum(point_per_stamp) as totalPoint')->first();
            
                $freeVoucher = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',1)
                                ->selectRaw('count(id) as totalFreeVoucher')->first();

                $superDeal = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',2)
                                ->selectRaw('count(id) as totalSuperDeal')->first();

                $superCode = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('category_id',3)
                                ->selectRaw('count(id) as totalSuperCode')->first();


                $birthdayCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',2)
                                ->selectRaw('sum(stamps) as totalBirthday')->first();

                $welcomeCount = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                ->whereDate('created_at','>=', $fromDate)
                                ->whereDate('created_at','<=', $toDate)
                                ->where('transaction_type_id',6)
                                ->selectRaw('sum(stamps) as totalWelcome')->first();
            }
            $transactionArray = [
                        "fromDate"=>$fromDate,
                        "toDate"=>$toDate,
                        "business_name"=>$business_details->name,
                        "rewardsStamp"=>$rewardsStamp->totalStamp,
                        "rewardsPoint"=>$rewardsPoint->totalPoint,
                        "freeVoucher"=>$freeVoucher->totalFreeVoucher,
                        "superDeal"=>$superDeal->totalSuperDeal,
                        "superCode"=>$superCode->totalSuperCode,
                        "birthdayCount"=>$birthdayCount->totalBirthday,
                        "welcomeCount"=>$birthdayCount->totalWelcome,
                    ];       
        
        $folder_path = '/business_admin_performance_excel/';
        if (!File::exists(public_path()  . $folder_path)) {
            File::makeDirectory(public_path() .  $folder_path, 0777, true);
        }
        $uniqid = uniqid();
        Excel::store(new BusinessAdminPerformanceExport($transactionArray), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        if (ob_get_contents())
        {
            ob_end_clean();
        }
        //ob_end_clean(); // this
        ob_start();

        $file_path_download = 'public/excel' . $folder_path  . $uniqid . '.xlsx';
        /*echo $file_path_download;
        exit;*/
        if (file_exists($file_path_download))
        {
            // Send Download
            return Response::download($file_path_download, $basename, [
                'Content-Type: application/vnd.ms-excel; charset=utf-8'
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }

        Session::flash("success","Excel saved successfully");
       // return Excel::download(new FinanceExport, $basename);

    

    }



    public function business_admin_user(Request $request)
    {   
        if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != ''&& isset($request->user_id) && $request->user_id != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $user_id = $request->user_id;
            $voucher_user = \App\Models\Voucher_upload_receipt::where('business_id',Auth::user()->userDetailsId)
                            ->where('user_id', $request->user_id)
                            ->whereDate('created_at','<=', $toDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

            $stamp_user = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                            ->where('user_id', $request->user_id)
                            ->whereDate('created_at','>=', $fromDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

             $voucher = [];
            foreach ($voucher_user as  $value) {
                array_push( $voucher, $value['user_id']);
            }

            $stamp = [];
            foreach ($stamp_user as  $value) {
                array_push( $stamp, $value['user_id']);
            }

            $final =  array_unique( array_merge($voucher, $stamp) );

            $userData = [];
            foreach ($final as $value) {
                $users = User::where('id',$value)->first();
                if(!empty($users))
                {
                    $userData[] = $users;
                }
            }

        }
        else if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $user_id = $request->user_id;
            $voucher_user = \App\Models\Voucher_upload_receipt::where('business_id',Auth::user()->userDetailsId)
                            ->whereDate('created_at','>=', $fromDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

            $stamp_user = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                            ->whereDate('created_at','>=', $fromDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

             $voucher = [];
            foreach ($voucher_user as  $value) {
                array_push( $voucher, $value['user_id']);
            }

            $stamp = [];
            foreach ($stamp_user as  $value) {
                array_push( $stamp, $value['user_id']);
            }

            $final =  array_unique( array_merge($voucher, $stamp) );

            $userData = [];
            foreach ($final as $value) {
                $users = User::where('id',$value)->first();
                if(!empty($users))
                {
                    $userData[] = $users;
                }
            }

        }
        else if(isset($request->user_id) && $request->user_id != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $user_id = $request->user_id;
            $voucher_user = \App\Models\Voucher_upload_receipt::where('business_id',Auth::user()->userDetailsId)
                            ->where('user_id', $request->user_id)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

            $stamp_user = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                            ->where('user_id', $request->user_id)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();

             $voucher = [];
            foreach ($voucher_user as  $value) {
                array_push( $voucher, $value['user_id']);
            }

            $stamp = [];
            foreach ($stamp_user as  $value) {
                array_push( $stamp, $value['user_id']);
            }

            $final =  array_unique( array_merge($voucher, $stamp) );

            $userData = [];
            foreach ($final as $value) {
                $users = User::where('id',$value)->first();
                if(!empty($users))
                {
                    $userData[] = $users;
                }
            }

        }
        else
        {
            $fromDate = \Carbon\Carbon::today()->toDateString();
            $toDate = \Carbon\Carbon::today()->toDateString();
            $user_id = '';
            $voucher_user = \App\Models\Voucher_upload_receipt::where('business_id',Auth::user()->userDetailsId)
                            ->whereDate('created_at','>=', $fromDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()->toArray();
            
            $stamp_user = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                            ->whereDate('created_at','>=', $fromDate)
                            ->whereDate('created_at','<=', $toDate)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()->toArray();

            $voucher = [];
            foreach ($voucher_user as  $value) {
                array_push( $voucher, $value['user_id']);
            }

            $stamp = [];
            foreach ($stamp_user as  $value) {
                array_push( $stamp, $value['user_id']);
            }

            $final =  array_unique( array_merge($voucher, $stamp) );

            $userData = [];
            foreach ($final as $value) {
                $users = User::where('id',$value)->first();
                if(!empty($users))
                {
                    $userData[] = $users;
                }
            }
        }


        $voucher_user_dropdown = \App\Models\Voucher_upload_receipt::where('business_id',Auth::user()->userDetailsId)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()->toArray();
            $stamp_user_dropdown = \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                            ->select('user_id')
                            ->groupBy('user_id')
                            ->get()->toArray();

            $voucher_dropdown = [];
            foreach ($voucher_user_dropdown as  $value) {
                array_push( $voucher_dropdown, $value['user_id']);
            }

            $stamp_dropdown = [];
            foreach ($stamp_user_dropdown as  $value) {
                array_push( $stamp_dropdown, $value['user_id']);
            }

            $final_dropdown =  array_unique( array_merge($voucher_dropdown, $stamp_dropdown) );

            $userData_dropdown = [];
            foreach ($final_dropdown as $value) {
                $users = User::where('id',$value)->first();
                if(!empty($users))
                {
                    $userData_dropdown[] = $users;
                }
            }
        $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

        return view('report.business_admin_user',compact('userData','userData_dropdown','user_id','business_details','fromDate','toDate'));
    }
    public function business_admin_order(Request $request)
    {   
        if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != ''&& isset($request->status) && $request->status != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;            
            $status = $request->status; 

            $orders_data = \App\Models\Member_orders::join('users','member_orders.member_id','users.id')
                    ->whereDate('member_orders.created_at','>=', $fromDate)
                    ->whereDate('member_orders.created_at','<=', $toDate)
                    ->where('member_orders.status', $status)
                    ->where('member_orders.created_by',Auth::user()->id)
                    ->select('member_orders.*','users.name','users.unique_no')
                    ->get();
        }
        else if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != '')
        {
            
            $fromDate = $request->from_date;
            $toDate = $request->to_date;            
            $status = '';

            $orders_data = \App\Models\Member_orders::join('users','member_orders.member_id','users.id')
                    ->whereDate('member_orders.created_at','>=', $fromDate)
                    ->whereDate('member_orders.created_at','<=', $toDate)
                    ->where('member_orders.created_by',Auth::user()->id)
                    ->select('member_orders.*','users.name','users.unique_no')
                    ->get();
        }
        else if(isset($request->status) && $request->status != '')
        {
            
            $fromDate = '';
            $toDate = '';
            $status = $request->status;
            $orders_data = \App\Models\Member_orders::join('users','member_orders.member_id','users.id')
                    ->where('member_orders.status', $status)
                    
                    ->where('member_orders.created_by',Auth::user()->id)
                    ->select('member_orders.*','users.name','users.unique_no')
                    ->get();

            

        }
        else
        {
            $fromDate = \Carbon\Carbon::today()->toDateString();
            $toDate = \Carbon\Carbon::today()->toDateString();
            $status = '';

            $orders_data = \App\Models\Member_orders::join('users','member_orders.member_id','users.id')
                    ->whereDate('member_orders.created_at','>=', $fromDate)
                    ->whereDate('member_orders.created_at','<=', $toDate)
                    ->where('member_orders.created_by',Auth::user()->id)
                    ->select('member_orders.*','users.name','users.unique_no')
                    ->get();

        }
        $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

        return view('report.business_admin_order',compact('orders_data','business_details','fromDate','toDate','status'));
    }

    public function business_admin_appointment(Request $request)
    {   
        if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != ''&& isset($request->status) && $request->status != '')
        {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;            
            $status = $request->status; 

            $appointment_data = \App\Models\Booked_services::join('users','booked_services.member_id','users.id')
                ->whereDate('booked_services.created_at','>=', $fromDate)
                ->whereDate('booked_services.created_at','<=', $toDate)
                ->where('booked_services.created_by',Auth::user()->id)
                ->where('booked_services.status',$status)
                ->select('booked_services.*','users.name','users.unique_no')
                ->get();

        }
        else if(isset($request->from_date) && $request->from_date != '' && isset($request->to_date) && $request->to_date != '')
        {
            
            $fromDate = $request->from_date;
            $toDate = $request->to_date;            
            $status = '';
            $appointment_data = \App\Models\Booked_services::join('users','booked_services.member_id','users.id')
                ->whereDate('booked_services.created_at','>=', $fromDate)
                ->whereDate('booked_services.created_at','<=', $toDate)
                ->where('booked_services.created_by',Auth::user()->id)
                ->select('booked_services.*','users.name','users.unique_no')
                ->get();
            
        }
        else if(isset($request->status) && $request->status != '')
        {
            
            $fromDate = '';
            $toDate = '';
            $status = $request->status;
            $appointment_data = \App\Models\Booked_services::join('users','booked_services.member_id','users.id')
                ->where('booked_services.created_by',Auth::user()->id)
                ->where('booked_services.status',$status)
                ->select('booked_services.*','users.name','users.unique_no')
                ->get();

        }
        else
        {
            $fromDate = \Carbon\Carbon::today()->toDateString();
            $toDate = \Carbon\Carbon::today()->toDateString();
            $status = '';

            $appointment_data = \App\Models\Booked_services::join('users','booked_services.member_id','users.id')
                ->where('booked_services.created_by',Auth::user()->id)
                ->whereDate('booked_services.created_at','>=', $fromDate)
                ->whereDate('booked_services.created_at','<=', $toDate)
                ->select('booked_services.*','users.name','users.unique_no')
                ->get();

        }
        $business_details = \App\Models\Brand::where('id',Auth::user()->userDetailsId)->first();

        return view('report.business_admin_appointment',compact('appointment_data','business_details','fromDate','toDate','status'));
    }
}
