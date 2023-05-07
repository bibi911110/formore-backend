<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOther_program_masterAPIRequest;
use App\Http\Requests\API\UpdateOther_program_masterAPIRequest;
use App\Models\Other_program_master;
use App\Repositories\Other_program_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Other_program_masterResource;
use Response;

/**
 * Class Other_program_masterController
 * @package App\Http\Controllers\API
 */

class Other_program_masterAPIController extends AppBaseController
{
    /** @var  Other_program_masterRepository */
    private $otherProgramMasterRepository;

    public function __construct(Other_program_masterRepository $otherProgramMasterRepo)
    {
        $this->otherProgramMasterRepository = $otherProgramMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/otherProgramMasters",
     *      summary="Get a listing of the Other_program_masters.",
     *      tags={"Other_program_master"},
     *      description="Get all Other_program_masters",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Other_program_master")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $otherProgramMasters = $this->otherProgramMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Other_program_masterResource::collection($otherProgramMasters), 'Other Program Masters retrieved successfully');
    }

    /**
     * @param CreateOther_program_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/otherProgramMasters",
     *      summary="Store a newly created Other_program_master in storage",
     *      tags={"Other_program_master"},
     *      description="Store Other_program_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Other_program_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Other_program_master")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Other_program_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        
        $check = \App\Models\Other_program_master::where('user_id',$request->user_id)
                                                   ->where('buss_id',$request->buss_id)
                                                   ->where('type_code',$request->type_code)
                                                   ->exists();
       
        if($check == 1)
        {
            //echo "string"; exit;
            return response(['status'=>'401','Message'=>'CODE ALREADY EXIST,CONTACT BUSINESS ADMINISTRATION.']);
        }
        else
        {
            $input = $request->all();
            /*echo "<pre>";
            print_r($input); exit;*/
            if($request->hasfile('upload_photo'))
            {
                $image = $request->file('upload_photo');
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $filename ='public/media/upload_photo/upload_photo/'.$image->getClientOriginalName();
                $path = public_path('/media/upload_photo/upload_photo/');
                $image->move($path, $filename);
                $input['upload_photo'] = $filename;
            }
            else
            {
                $input['upload_photo'] = '';
            }
            if($request->hasfile('upload_photo_1'))
            {
                $image = $request->file('upload_photo_1');
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $filename ='public/media/upload_photo/upload_photo_1/'.$image->getClientOriginalName();
                $path = public_path('/media/upload_photo/upload_photo_1/');
                $image->move($path, $filename);
                $input['upload_photo_1'] = $filename;
            }
            else
            {
                $input['upload_photo_1'] = '';
            }
             
            if($request->hasfile('barcode_image'))
            {
                $image = $request->file('barcode_image');
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $filename ='public/media/upload_photo/barcode_image/'.$image->getClientOriginalName();
                $path = public_path('/media/upload_photo/barcode_image/');
                $image->move($path, $filename);
                $input['barcode_image'] = $filename;
            }
            else
            {
                $input['barcode_image'] = '';
            }


            $otherProgramMaster = $this->otherProgramMasterRepository->create($input);
            if($otherProgramMaster != ''){
                return response(['status'=>'200','Message'=>'Other Program Master saved successfully.','loyaltyBannerMasters' => $otherProgramMaster]);
            }else{
                return response(['status'=>'401','Message'=>"Other Program Master Not saved"]);
            }

        }
        

        //return $this->sendResponse(new Other_program_masterResource($otherProgramMaster), 'Other Program Master saved successfully');
    }

     public function other_business_list(Request $request)
    {
       // $buss_id = \App\User::where('id',$request->buss_id)->first();
        $business_list = \App\Models\Brand::where('country_id',$request->country_id)->where('other_program',1)->get();

        if($business_list != ''){
            return response(['status'=>'200','Message'=>'Business found.','business_list' => $business_list]);
        }else{
            return response(['status'=>'401','Message'=>"Business not found"]);
        }

    }

    public function other_progrom_list(Request $request)
    {
        $progrom_list = \App\Models\Other_program_master::where('user_id',$request->user_id)
                                                ->where('buss_id',$request->buss_id)
                                                ->get();
        if($progrom_list != ''){
            return response(['status'=>'200','Message'=>'Business found.','progrom_list' => $progrom_list]);
        }else{
            return response(['status'=>'401','Message'=>"Business not found"]);
        }
    }

    public function business_loyalty_card(Request $request)
     {  
      $user_id = \App\User::where('role_id','3')
                            ->where('id',$request['buss_id'])
                            ->first(); 
    /*echo "<pre>";
    print_r($user_id->userDetailsId); exit;*/

        $my_rewards1 = \App\User::leftjoin('my_rewards','users.id','my_rewards.user_id')
                                ->leftjoin('stamp_master','my_rewards.buss_id','stamp_master.business_id')
                                ->leftjoin('brand','my_rewards.buss_id','brand.id')
                                ->leftjoin('bussiness_wise_stamp_point','my_rewards.buss_id','bussiness_wise_stamp_point.business_id')
                                ->where('my_rewards.user_id',$request->user_id)
                               // ->where('stamp_master.business_id',$user_id->userDetailsId)
                                ->where('brand.stamp_point','1')
                                /*->OrWhere('users.stamp','!=',0)
                                ->OrWhere('users.point','!=',0)*/
                                ->select('my_rewards.*','users.stamp as ustamp','users.point','brand.name as brandName','brand.brand_icon','stamp_master.business_id','stamp_master.color','stamp_master.image_of_loyalty_card','stamp_master.font_size','bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                ->orderBy('my_rewards.id','DESC')
                                //->groupBy('my_rewards.id')
                                ->groupBy('my_rewards.buss_id')
                                ->get();  

        $my_rewards = [];
        foreach ($my_rewards1 as $value) {
             $brandName = \App\Models\Brand::where('id',@$user_id->userDetailsId)->first();
             $stamp_data = \App\Models\Stamp_master::where('business_id',@$user_id->userDetailsId)->first();
             $buss_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',@$user_id->userDetailsId)->first();
           $my_rewards[] = array('id' => $value->id,
                                 'user_id' => $value->user_id,
                                 'nfc_code' => $value->nfc_code,
                                 'buss_id' => $value->buss_id,
                                 'stamps' => $value->stamps,
                                 'setup_level' => $value->setup_level,
                                 'point_per_stamp' => $value->point_per_stamp,
                                 'setup_level_count' => $value->setup_level_count,
                                 'created_at' => $value->created_at,
                                 'updated_at' => $value->updated_at,
                                 'deleted_at' => $value->deleted_at,
                                 'ustamp' => $buss_data->total_stamp,
                                 'point' => $buss_data->total_point,
                                 'brandName' => $brandName->name,
                                 'brand_icon' => $brandName->brand_icon,
                                 'business_id' => $brandName->id,
                                 'color' => @$stamp_data->color,
                                 'image_of_loyalty_card' => @$stamp_data->image_of_loyalty_card,
                                 'font_size' => @$stamp_data->font_size,
                                 'total_stamp' => $buss_data->total_stamp,
                                 'total_point' => $buss_data->total_point,
                                );
        }



        if(!empty($my_rewards) && count($my_rewards) > 0)
        {


          $my_rewards_point = \App\User::leftjoin('brand','users.business_id','brand.id')
                                  //->leftjoin('stamp_master','users.business_id','stamp_master.business_id')
                                  ->leftjoin('points_master','users.business_id','points_master.business_id')
                                  ->leftjoin('bussiness_wise_stamp_point','users.business_id','bussiness_wise_stamp_point.business_id')
                                  ->where('users.id',$request->user_id)
                                  //->where('points_master.business_id',$user_id->userDetailsId)
                                  ->where('brand.stamp_point','2')
                                  ->select('points_master.*','bussiness_wise_stamp_point.total_point as point','brand.name as brandName','brand.id as  brans_id','brand.brand_icon')
                                 // ->orderBy('my_rewards.id','DESC')
                                  /*->where('stamp_master.deleted_at', NULL)
                                  ->where('brand.deleted_at', NULL)
                                  ->where('points_master.deleted_at', NULL)*/
                                  ->groupBy('users.id')
                                  ->groupBy('brand.id')
                                  ->get();
        }
        else
        {
            $my_rewards_point = [];
        }
        if(!empty($my_rewards) || !empty($my_rewards_point)){
            return response(['status'=>'200','Message'=>'Business loyalty card found.',"business_loyalty_card" => $my_rewards,'my_rewards_point' =>$my_rewards_point]);
        }else{
            return response(['status'=>'401','Message'=>"You don’t have yet visit the business collect"]);
        }
    }
   /* {
        $business_loyalty_card = \App\Models\My_rewards::leftjoin('stamp_master','my_rewards.buss_id','stamp_master.business_id')
                                ->where('my_rewards.user_id',$request->user_id)
                                ->where('my_rewards.buss_id',$request->buss_id)
                                 ->select('my_rewards.*','stamp_master.business_id','stamp_master.color','stamp_master.image_of_loyalty_card','stamp_master.font_size')
                                ->first();

        if($business_loyalty_card != ''){
            return response(['status'=>'200','Message'=>'Business loyalty card found.','business_list' => $business_loyalty_card]);
        }else{
            return response(['status'=>'401','Message'=>"Business loyalty card not found"]);
        }

    }*/

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/otherProgramMasters/{id}",
     *      summary="Display the specified Other_program_master",
     *      tags={"Other_program_master"},
     *      description="Get Other_program_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Other_program_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Other_program_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Other_program_master $otherProgramMaster */
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            return $this->sendError('Other Program Master not found');
        }

        return $this->sendResponse(new Other_program_masterResource($otherProgramMaster), 'Other Program Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOther_program_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/otherProgramMasters/{id}",
     *      summary="Update the specified Other_program_master in storage",
     *      tags={"Other_program_master"},
     *      description="Update Other_program_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Other_program_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Other_program_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Other_program_master")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Other_program_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOther_program_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Other_program_master $otherProgramMaster */
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            return $this->sendError('Other Program Master not found');
        }

        $otherProgramMaster = $this->otherProgramMasterRepository->update($input, $id);

        return $this->sendResponse(new Other_program_masterResource($otherProgramMaster), 'Other_program_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/otherProgramMasters/{id}",
     *      summary="Remove the specified Other_program_master from storage",
     *      tags={"Other_program_master"},
     *      description="Delete Other_program_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Other_program_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Other_program_master $otherProgramMaster */
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            return $this->sendError('Other Program Master not found');
        }

        $otherProgramMaster->delete();

        return $this->sendSuccess('Other Program Master deleted successfully');
    }
}
