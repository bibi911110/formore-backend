<?php

namespace App\Http\Controllers;

use App\DataTables\VoucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Repositories\VoucherRepository;
use Flash;
use App\Exports\VoucherExport;
use App\Imports\CouponImport;
use App\Http\Controllers\AppBaseController;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Models\Voucher;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Symfony\Component\Console\Input\Input;
use Validator;

//use Carbon\Carbon;

class VoucherController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->voucherRepository = $voucherRepo;

        $this->middleware('permission:vouchers-index|vouchers-create|vouchers-edit|vouchers-delete', ['only' => ['index','store']]);
        $this->middleware('permission:vouchers-create', ['only' => ['create','store']]);
        $this->middleware('permission:vouchers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vouchers-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Voucher.
     *
     * @param VoucherDataTable $voucherDataTable
     * @return Response
     */
    public function index(VoucherDataTable $voucherDataTable)
    {
        //return $voucherDataTable->render('vouchers.index');

        $data = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
        return view('vouchers.index',compact('data'));
    }

     public function lotery_code_details_scenario_2()
    {
        //return $voucherDataTable->render('vouchers.index');

        $data = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->where('voucher.scenario_type','2')
            ->orderBy('voucher.id','DESC')->get();
        return view('vouchers.lotery_code_details_scenario_2',compact('data'));
    }
    public function lotery_code_details_scenario_1()
    {
        //return $voucherDataTable->render('vouchers.index');

        $data = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->where('voucher.scenario_type','1')
            ->orderBy('voucher.id','DESC')->get();
        return view('vouchers.lotery_code_details_scenario_1',compact('data'));
    }

    /**
     * Show the form for creating a new Voucher.
     *
     * @return Response
     */
    public function create()
    {
        $code_string = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        $voucher_category = \App\Models\Voucher_category::where('status','1')->pluck('voucher_category','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        return view('vouchers.create',compact('brands','voucher_category','code_string','country_data'));
    }

    /**
     * Store a newly created Voucher in storage.
     *
     * @param CreateVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucherRequest $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'business_id' => 'required',
                    'country_id' => 'required',
                    'category_id' => 'required',
            ]);

        if($input['upload_option'] == 1)
        {
            if($input['category_id'] == 3)
            {

                if(isset($request->levels_based_on_scenarios) && $request->levels_based_on_scenarios != '' )
                {
                    $levels_based_on_scenarios = $request->levels_based_on_scenarios;
                }
                else
                {
                    $levels_based_on_scenarios = '';
                }
                $result = Excel::toArray(new CouponImport, $request->file('voucher_file'));
                $finalArray = array_filter($result[0], 'array_filter');
                
                $count = count($finalArray[0]);
                $countData = count($finalArray);
                $error_array = [];
                for ($j = 1; $j < $countData; $j++) {
                    for ($i = 0; $i < $count; $i++) {
                        //echo $result[0][0][$i];

                        if ($finalArray[0][$i] != '') {
                            if($finalArray[0][$i] == 'voucher_start_date')
                            {   
                                $dateData1 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $startDate =  \Carbon\Carbon::parse($dateData1)->format('Y-m-d');
                                $array['start_date'] = $startDate;
                            }
                            if($finalArray[0][$i] == 'voucher_end_date')
                            {      
                                $dateData12 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $endDate =  \Carbon\Carbon::parse($dateData12)->format('Y-m-d');
                                $array['end_date'] = $endDate;
                            }
                            if($finalArray[0][$i] == 'voucher_campaign_start_date')
                            {      
                                $dateData12 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $endDate =  \Carbon\Carbon::parse($dateData12)->format('Y-m-d');
                                $array['campaign_start_date'] = $endDate;
                            }
                            if($finalArray[0][$i] == 'voucher_campaign_end_date')
                            {      
                                $dateData12 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $endDate =  \Carbon\Carbon::parse($dateData12)->format('Y-m-d');
                                $array['campaign_end_date'] = $endDate;
                            }
                            
                            if($finalArray[0][$i] == 'voucher_campaign_date')
                            {      
                                $dateData12 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $endDate =  \Carbon\Carbon::parse($dateData12)->format('Y-m-d');
                                $array['date_of_campaign'] = $endDate;
                            }
                            //echo $finalArray[$j][$i]."<br>";
                            else
                            {
                                $array[$finalArray[0][$i]] = $finalArray[$j][$i];
                                $array['country_id'] = $input['country_id'];
                                $array['business_id'] = $input['business_id'];
                                $array['category_id'] = $input['category_id'];
                                $array['campaign_type'] = $input['campaign_type'];
                                $array['levels_based_on_scenarios'] = $levels_based_on_scenarios;

                                
                            }
                        } 
                    }
                    
                    $checkCode = Voucher::select('id')->where('code',$array['code'])->exists();
                    if($checkCode == 1)
                    {
                            $export_array[] = [
                                
                            //'product_name' => $finalArray[$j]['ean'],
                            'code'          => $array['code'],
                            'message'      => "code already exists",
                        ];       
                    }
                    else
                    {
                        /*qrcode*/
                         
                         $string_code = (string)$array['code']; 

                        $qr_img = 'data:image/png;base64,' . \DNS2D::getBarcodePNG($string_code, 'QRCODE');

                        $qr_image =$qr_img;
                        $qr_image = str_replace('data:image/png;base64,', '', $qr_image);
                        $qr_image = str_replace(' ', '+', $qr_image);
                        $qr_imageName = $array['code'].\Str::random(10).'.'.'png';
                        file_put_contents(public_path().'/voucher_qrcode/' .$qr_imageName, base64_decode($qr_image));
                        $array['qr_code'] = 'public/voucher_qrcode/'.$qr_imageName;

                        $img = 'data:image/png;base64,' . \DNS1D::getBarcodePNG($string_code, 'C39+', true);
                        $image = $img;  // your base64 encoded
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = $array['code'].\Str::random(10).'.'.'png';
                        file_put_contents(public_path().'/voucher_barcode/' .$imageName, base64_decode($image));
                        $array['bar_code_image'] = 'public/voucher_barcode/'.$imageName;

                        
                        $voucher = $this->voucherRepository->create($array);
                    }
                    //$question_details = QuestionDetails::create($array);
                }
                    if(!empty($export_array))
                    {
                        $folder_path = '/voucher/'.date('Y-m-d');
                        if (!File::exists(public_path()  . $folder_path)) {
                            File::makeDirectory(public_path() .  $folder_path, 0777, true);
                        }
                        $uniqid = uniqid();
                        Excel::store(new VoucherExport($export_array), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

                        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
                        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
                        $basename = $uniqid.'.xlsx';
                        $path = $uniqid.'.xlsx';
                        ob_end_clean(); // this
                        ob_start(); // and this                

                        Flash::success('Code Already Exist, <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

                        return redirect(route('vouchers.index'));
                }
            }
            else
            {
               // $input['campaign_type'] = 0;
                $result = Excel::toArray(new CouponImport, $request->file('voucher_file'));
                $finalArray = array_filter($result[0], 'array_filter');
                $count = count($finalArray[0]);
                $countData = count($finalArray);
                $error_array = [];
                for ($j = 1; $j < $countData; $j++) {
                    for ($i = 0; $i < $count; $i++) {
                        //echo $result[0][0][$i];
                        if ($finalArray[0][$i] != '') {
                            if($finalArray[0][$i] == 'voucher_start_date')
                            {   
                                $dateData1 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $startDate =  \Carbon\Carbon::parse($dateData1)->format('Y-m-d');
                                $array['start_date'] = $startDate;
                            }
                            if($finalArray[0][$i] == 'voucher_end_date')
                            {      
                                $dateData12 = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($finalArray[$j][$i]));
                                $endDate =  \Carbon\Carbon::parse($dateData12)->format('Y-m-d');
                                $array['end_date'] = $endDate;
                            }
                            
                            //echo $finalArray[$j][$i]."<br>";
                            else
                            {
                                $array[$finalArray[0][$i]] = $finalArray[$j][$i];
                                $array['country_id'] = $input['country_id'];
                                $array['business_id'] = $input['business_id'];
                                $array['category_id'] = $input['category_id'];
                            }
                        } 
                    }
                    
                    $checkCode = Voucher::select('id')->where('code',$array['code'])->exists();
                    if($checkCode == 1)
                    {
                            $export_array[] = [
                            //'product_name' => $finalArray[$j]['ean'],
                            'code'          => $array['code'],
                            'message'      => "code already exists",
                        ];       
                    }
                    else
                    {
                        /*barcode*/
                        $string_code = (string)$array['code']; 

                        $img = 'data:image/png;base64,' . \DNS1D::getBarcodePNG($string_code, 'C39+', true);
                        $image = $img;  // your base64 encoded
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = $array['code'].\Str::random(10).'.'.'png';
                        file_put_contents(public_path().'/voucher_barcode/' .$imageName, base64_decode($image));
                        $array['bar_code_image'] = 'public/voucher_barcode/'.$imageName;

                        /*qr code*/ 
                        $qr_img = 'data:image/png;base64,' . \DNS2D::getBarcodePNG($string_code, 'QRCODE');
                        $qr_image =$qr_img;
                        $qr_image = str_replace('data:image/png;base64,', '', $qr_image);
                        $qr_image = str_replace(' ', '+', $qr_image);
                        $qr_imageName = $array['code'].\Str::random(10).'.'.'png';
                        file_put_contents(public_path().'/voucher_qrcode/' .$qr_imageName, base64_decode($qr_image));
                        $array['qr_code'] = 'public/voucher_qrcode/'.$qr_imageName;
                        
                        $voucher = $this->voucherRepository->create($array);
                    }
                    //$question_details = QuestionDetails::create($array);
                }
                    if(!empty($export_array))
                    {
                        $folder_path = '/voucher/'.date('Y-m-d');
                        if (!File::exists(public_path()  . $folder_path)) {
                            File::makeDirectory(public_path() .  $folder_path, 0777, true);
                        }
                        $uniqid = uniqid();
                        Excel::store(new VoucherExport($export_array), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

                        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
                        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
                        $basename = $uniqid.'.xlsx';
                        $path = $uniqid.'.xlsx';
                        ob_end_clean(); // this
                        ob_start(); // and this                

                        Flash::success('Code Already Exist, <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

                        return redirect(route('vouchers.index'));
                }
            }
        }
        else
        {
            if($input['scenario_type'] == 2)
            {

                $this->validate($request, [
                    'business_id' => 'required',
                    'category_id' => 'required',
                    'campaign_type' => 'required',
                    'scenario_2_file' => 'required|mimes:xlsx',
                    'code' => 'required|string|unique:voucher,code',
                ]);
                                
                if($request->hasfile('icon'))
                    {
                        $image = $request->file('icon');
                        $extension = $image->getClientOriginalExtension(); // getting image extension
                        $filename ='public/media/voucher/icon/'.$image->getClientOriginalName();
                        $path = public_path('/media/voucher/icon/');
                        $image->move($path, $filename);
                        $input['icon'] = $filename;
                    }else
                    {
                        $input['icon'] = '';
                    }
                    if($request->hasfile('image'))
                    {
                        $image = $request->file('image');
                        $extension = $image->getClientOriginalExtension(); // getting image extension
                        $filename ='public/media/voucher/image/'.$image->getClientOriginalName();
                        $path = public_path('/media/voucher/image/');
                        $image->move($path, $filename);
                        $input['image'] = $filename;
                    }else
                    {
                        $input['image'] = '';
                    }
                    if($request->hasfile('banner_image'))
                    {
                        $image = $request->file('banner_image');
                        $extension = $image->getClientOriginalExtension(); // getting image extension
                        $filename ='public/media/voucher/banner_image/'.$image->getClientOriginalName();
                        $path = public_path('/media/voucher/banner_image/');
                        $image->move($path, $filename);
                        $input['banner_image'] = $filename;
                    }else
                    {
                        $input['banner_image'] = '';
                    }
                    $input['status']  = 1;
                    
                    $voucher = $this->voucherRepository->create($input);
                    
                    /*Excel Start*/
                    $result = Excel::toArray(new CouponImport, $request->file('scenario_2_file'));
                    $finalArray = array_filter($result[0], 'array_filter');
                    $count = count($finalArray[0]);
                    $countData = count($finalArray);
                    $error_array = [];
                    for ($j = 1; $j < $countData; $j++) {
                        for ($i = 0; $i < $count; $i++) {
                            //echo $result[0][0][$i];
                            if ($finalArray[0][$i] != '') {                                  
                                $array[$finalArray[0][$i]] = $finalArray[$j][$i];
                                $array['voucher_id'] = $voucher->id;
                            } 
                        }
                        $checkCodeExist = \App\Models\Lotery_code_details::select('id')->where('lotery_code',$array['lotery_code'])->exists();
                        
                        if($checkCodeExist == 1)
                        {
                                $export_array[] = [
                                //'product_name' => $finalArray[$j]['ean'],
                                'code'          => $array['lotery_code'],
                                'message'      => "code already exists",
                            ];       
                        }
                        else
                        {
                            /*barcode*/
                            $string_code = (string)$array['lotery_code']; 
    
                            $img = 'data:image/png;base64,' . \DNS1D::getBarcodePNG($string_code, 'C39+', true);
                            $image = $img;  // your base64 encoded
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $imageName = $string_code.\Str::random(10).'.'.'png';
                            file_put_contents(public_path().'/voucher_barcode/' .$imageName, base64_decode($image));
                            $array['bar_code'] = 'public/voucher_barcode/'.$imageName;
    
                            /*qr code*/ 
                            $qr_img = 'data:image/png;base64,' . \DNS2D::getBarcodePNG($string_code, 'QRCODE');
                            $qr_image =$qr_img;
                            $qr_image = str_replace('data:image/png;base64,', '', $qr_image);
                            $qr_image = str_replace(' ', '+', $qr_image);
                            $qr_imageName = $string_code.\Str::random(10).'.'.'png';
                            file_put_contents(public_path().'/voucher_qrcode/' .$qr_imageName, base64_decode($qr_image));
                            $array['qr_code_image'] = 'public/voucher_qrcode/'.$qr_imageName;
                            //$voucher = $this->voucherRepository->create($array);
                            $lotery_details = \App\Models\Lotery_code_details::create($array);
                        }
                        //$question_details = QuestionDetails::create($array);
                    }       
                    
                    if(!empty($export_array))
                    {
                        $folder_path = '/voucher/'.date('Y-m-d');
                        if (!File::exists(public_path()  . $folder_path)) {
                            File::makeDirectory(public_path() .  $folder_path, 0777, true);
                        }
                        $uniqid = uniqid();
                        Excel::store(new VoucherExport($export_array), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

                        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
                        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
                        $basename = $uniqid.'.xlsx';
                        $path = $uniqid.'.xlsx';
                        ob_end_clean(); // this
                        ob_start(); // and this                

                        Flash::success('Code Already Exist, <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

                        return redirect(route('vouchers.index'));
                }
                    //exit;
                    /*Excel End*/
                    
            }
            else
            {
                
                $this->validate($request, [
                    'code' => 'required|string|unique:voucher,code',
                ]);
                /*qrcode*/
                $img = 'data:image/png;base64,' . \DNS2D::getBarcodePNG($input['code'], 'QRCODE');
                $image = $img;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $input['code'].\Str::random(10).'.'.'png';
                file_put_contents(public_path().'/voucher_qrcode/' .$imageName, base64_decode($image));
                $input['qr_code'] = 'public/voucher_qrcode/'.$imageName;

                /*barcode*/
                $img = 'data:image/png;base64,' . \DNS1D::getBarcodePNG($input['code'], 'C39+', true);
                $image = $img;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $input['code'].\Str::random(10).'.'.'png';
                file_put_contents(public_path().'/voucher_barcode/' .$imageName, base64_decode($image));
                $input['bar_code_image'] = 'public/voucher_barcode/'.$imageName;

                

                if($request->hasfile('icon'))
                {
                    $image = $request->file('icon');
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $filename ='public/media/voucher/icon/'.$image->getClientOriginalName();
                    $path = public_path('/media/voucher/icon/');
                    $image->move($path, $filename);
                    $input['icon'] = $filename;
                }else
                {
                    $input['icon'] = '';
                }
                if($request->hasfile('image'))
                {
                    $image = $request->file('image');
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $filename ='public/media/voucher/image/'.$image->getClientOriginalName();
                    $path = public_path('/media/voucher/image/');
                    $image->move($path, $filename);
                    $input['image'] = $filename;
                }else
                {
                    $input['image'] = '';
                }

                if($request->hasfile('banner_image'))
                {

                    $image = $request->file('banner_image');
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $filename ='public/media/voucher/banner_image/'.$image->getClientOriginalName();
                    $path = public_path('/media/voucher/banner_image/');
                    $image->move($path, $filename);
                    $input['banner_image'] = $filename;
                }else
                {
                    $input['banner_image'] = '';
                }
                if($request->lotery_point == 'stamp')
                {
                    $input['stamp']  = 1;
                }
                unset($input['lotery_point']);
                $input['status']  = 1;
                $voucher = $this->voucherRepository->create($input);
            }
        }

        Flash::success('Voucher  saved successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Display the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        return view('vouchers.show')->with('voucher', $voucher);
    }

    /**
     * Show the form for editing the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        $voucher_category = \App\Models\Voucher_category::where('status','1')->pluck('voucher_category','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');

        return view('vouchers.edit',compact('brands','voucher_category','country_data'))->with('voucher', $voucher);
    }

    /**
     * Update the specified Voucher in storage.
     *
     * @param  int              $id
     * @param UpdateVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucherRequest $request)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $input = $request->all();
        
        if($request->hasfile('icon'))
        {

            $image = $request->file('icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/voucher/icon/'.$image->getClientOriginalName();
            $path = public_path('/media/voucher/icon/');
            $image->move($path, $filename);
            $input['icon'] = $filename;
        }else
        {
            $input['icon'] = $voucher['icon'];
        }

        if($request->hasfile('image'))
        {

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/voucher/image/'.$image->getClientOriginalName();
            $path = public_path('/media/voucher/image/');
            $image->move($path, $filename);
            $input['image'] = $filename;
        }else
        {
            $input['image'] = $voucher['image'];
        }

        if($request->hasfile('banner_image'))
        {

            $image = $request->file('banner_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/voucher/banner_image/'.$image->getClientOriginalName();
            $path = public_path('/media/voucher/banner_image/');
            $image->move($path, $filename);
            $input['banner_image'] = $filename;
        }else
        {
            $input['banner_image'] = $voucher['banner_image'];
        }

        $input['status']  = 1;

        $voucher = $this->voucherRepository->update($input, $id);

        Flash::success('Voucher updated successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Remove the specified Voucher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = $this->voucherRepository->find($id);
        $data = Date('Y-m-d : h:s:i');
        
        $voucher = \App\Models\User_voucher::where('voucher_id', $id)->update(['deleted_at' => $data]);
        $voucher_lotry = \App\Models\Lotery_code_details::where('voucher_id', $id)->update(['deleted_at' => $data]);
        $voucher_lotry_s2 = \App\Models\Loyalty_code_scenario1::where('voucher_id', $id)->update(['deleted_at' => $data]);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $this->voucherRepository->delete($id);

        Flash::success('Voucher deleted successfully.');

        return redirect(route('vouchers.index'));
    }

    public function vouchers_status($id, $status)
    {

       $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $voucher = $this->voucherRepository->update($data, $id);

        Flash::success('Vouchers status updated successfully.');

        return redirect(route('vouchers.index'));
    }
}
