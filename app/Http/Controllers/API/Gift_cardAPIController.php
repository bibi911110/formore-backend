<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGift_cardAPIRequest;
use App\Http\Requests\API\UpdateGift_cardAPIRequest;
use App\Models\Gift_card;
use App\Repositories\Gift_cardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Gift_cardResource;
use Response;
use App\Helper\Voucher_master;

/**
 * Class Gift_cardController
 * @package App\Http\Controllers\API
 */

class Gift_cardAPIController extends AppBaseController
{
    /** @var  Gift_cardRepository */
    private $giftCardRepository;

    public function __construct(Gift_cardRepository $giftCardRepo)
    {
        $this->giftCardRepository = $giftCardRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/giftCards",
     *      summary="Get a listing of the Gift_cards.",
     *      tags={"Gift_card"},
     *      description="Get all Gift_cards",
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
     *                  @SWG\Items(ref="#/definitions/Gift_card")
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
        $giftCards = $this->giftCardRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Gift_cardResource::collection($giftCards), 'Gift Cards retrieved successfully');
    }

    /**
     * @param CreateGift_cardAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/giftCards",
     *      summary="Store a newly created Gift_card in storage",
     *      tags={"Gift_card"},
     *      description="Store Gift_card",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gift_card that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gift_card")
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
     *                  ref="#/definitions/Gift_card"
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
        $input = $request->all();

        $user = \App\User::where('email',$input['to_email'])->first();
        $sender = \App\User::where('id',$input['user_id'])->first();
        $voucher_details = \App\Models\Voucher::where('id',$input['voucher_id'])->first();
        $end_date = date('d-m-Y',strtotime($voucher_details->end_date));
        $date_days = date('Y-m-d', strtotime($end_date.'-'.$voucher_details->days.'days' ));
        $today = date('Y-m-d');
        if($date_days > $today)
        {
            if(!empty($user))
            {
                $input['to_user_id'] = $user->id;
                $input['user_id'] = $request->user_id;

                $user_voucher['assigned_user_id'] = $user->id;
                $user_voucher['used_code_status'] = 1;
                
                $credit['voucher_id'] = $input['voucher_id'];
                $credit['user_id'] = $user->id;
                $credit['used_code_status'] = 0;
                //$credit['assigned_user_id'] = $request->user_id;

                $userVoucher = \App\Models\User_voucher::where('user_id',$request->user_id)->where('voucher_id',$request->voucher_id)->update($user_voucher);
                $userVoucher = \App\Models\User_voucher::create($credit);

                $firebaseToken = \App\User::where('users.role_id',4)->where('id',$user->id)->whereNotNull('device_token')->pluck('device_token')->all();
            
                //where('id',14)
                $message = $sender->name."has send you gift voucher";
                $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 
                $data = [
                    "registration_ids" => $firebaseToken,
                    "notification" => [
                        "title" => "Gift Voucher",
                        
                    ], 
                    "data" => [
                        "message" =>$message,
                        "type" => "Gift Voucher",
                    ]         
                ];
                $dataString = json_encode($data);  

                /*echo "<pre>";
                print_r($dataString); exit;*/
                $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',

                ];
                $ch = curl_init();    
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                $response = curl_exec($ch);
                $data = json_decode($response);

                $giftCard = $this->giftCardRepository->create($input);
                return $this->sendResponse(new Gift_cardResource($giftCard), 'Gift Card saved successfully');
            }
            else
            {
                $user_voucher['assigned_user_id'] = @$user->id;
                $user_voucher['used_code_status'] = 1;

                 $userVoucher = \App\Models\User_voucher::where('user_id',$request->user_id)->where('voucher_id',$request->voucher_id)->update($user_voucher);


                $input['voucher_code'] = $voucher_details->code;
                $response = Voucher_master::send_email($input);       
                $giftCard = $this->giftCardRepository->create($input);



                return response(['success'=> true,'message'=>'Gift voucher send successfully.']);

            }
        }else{
            return response(['success'=>false,'message'=>"Gift voucher date limits close..."]);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/giftCards/{id}",
     *      summary="Display the specified Gift_card",
     *      tags={"Gift_card"},
     *      description="Get Gift_card",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_card",
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
     *                  ref="#/definitions/Gift_card"
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
        /** @var Gift_card $giftCard */
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            return $this->sendError('Gift Card not found');
        }

        return $this->sendResponse(new Gift_cardResource($giftCard), 'Gift Card retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGift_cardAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/giftCards/{id}",
     *      summary="Update the specified Gift_card in storage",
     *      tags={"Gift_card"},
     *      description="Update Gift_card",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_card",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gift_card that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gift_card")
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
     *                  ref="#/definitions/Gift_card"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGift_cardAPIRequest $request)
    {
        $input = $request->all();

        /** @var Gift_card $giftCard */
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            return $this->sendError('Gift Card not found');
        }

        $giftCard = $this->giftCardRepository->update($input, $id);

        return $this->sendResponse(new Gift_cardResource($giftCard), 'Gift_card updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/giftCards/{id}",
     *      summary="Remove the specified Gift_card from storage",
     *      tags={"Gift_card"},
     *      description="Delete Gift_card",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_card",
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
        /** @var Gift_card $giftCard */
        $giftCard = $this->giftCardRepository->find($id);

        if (empty($giftCard)) {
            return $this->sendError('Gift Card not found');
        }

        $giftCard->delete();

        return $this->sendSuccess('Gift Card deleted successfully');
    }
}
