<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVoucher_upload_receiptAPIRequest;
use App\Http\Requests\API\UpdateVoucher_upload_receiptAPIRequest;
use App\Models\Voucher_upload_receipt;
use App\Repositories\Voucher_upload_receiptRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Voucher_upload_receiptResource;
use Response;

/**
 * Class Voucher_upload_receiptController
 * @package App\Http\Controllers\API
 */

class Voucher_upload_receiptAPIController extends AppBaseController
{
    /** @var  Voucher_upload_receiptRepository */
    private $voucherUploadReceiptRepository;

    public function __construct(Voucher_upload_receiptRepository $voucherUploadReceiptRepo)
    {
        $this->voucherUploadReceiptRepository = $voucherUploadReceiptRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/voucherUploadReceipts",
     *      summary="Get a listing of the Voucher_upload_receipts.",
     *      tags={"Voucher_upload_receipt"},
     *      description="Get all Voucher_upload_receipts",
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
     *                  @SWG\Items(ref="#/definitions/Voucher_upload_receipt")
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
        $voucherUploadReceipts = $this->voucherUploadReceiptRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Voucher_upload_receiptResource::collection($voucherUploadReceipts), 'Voucher Upload Receipts retrieved successfully');
    }

    /**
     * @param CreateVoucher_upload_receiptAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/voucherUploadReceipts",
     *      summary="Store a newly created Voucher_upload_receipt in storage",
     *      tags={"Voucher_upload_receipt"},
     *      description="Store Voucher_upload_receipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher_upload_receipt that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher_upload_receipt")
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
     *                  ref="#/definitions/Voucher_upload_receipt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVoucher_upload_receiptAPIRequest $request)
    {
        $input = $request->all();

        if($request->hasfile('upload_receipt'))
        {

            $image = $request->file('upload_receipt');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/upload_receipt/'.$image->getClientOriginalName();
            $path = public_path('/media/upload_receipt/');
            $image->move($path, $filename);
            $input['upload_receipt'] = $filename;
        }else
        {
            $input['upload_receipt'] = '';
        }
        
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->create($input);

        return $this->sendResponse(new Voucher_upload_receiptResource($voucherUploadReceipt), 'Voucher Upload Receipt saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/voucherUploadReceipts/{id}",
     *      summary="Display the specified Voucher_upload_receipt",
     *      tags={"Voucher_upload_receipt"},
     *      description="Get Voucher_upload_receipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_upload_receipt",
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
     *                  ref="#/definitions/Voucher_upload_receipt"
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
        /** @var Voucher_upload_receipt $voucherUploadReceipt */
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            return $this->sendError('Voucher Upload Receipt not found');
        }

        return $this->sendResponse(new Voucher_upload_receiptResource($voucherUploadReceipt), 'Voucher Upload Receipt retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVoucher_upload_receiptAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/voucherUploadReceipts/{id}",
     *      summary="Update the specified Voucher_upload_receipt in storage",
     *      tags={"Voucher_upload_receipt"},
     *      description="Update Voucher_upload_receipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_upload_receipt",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher_upload_receipt that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher_upload_receipt")
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
     *                  ref="#/definitions/Voucher_upload_receipt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVoucher_upload_receiptAPIRequest $request)
    {
        $input = $request->all();

        /** @var Voucher_upload_receipt $voucherUploadReceipt */
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            return $this->sendError('Voucher Upload Receipt not found');
        }

        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->update($input, $id);

        return $this->sendResponse(new Voucher_upload_receiptResource($voucherUploadReceipt), 'Voucher_upload_receipt updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/voucherUploadReceipts/{id}",
     *      summary="Remove the specified Voucher_upload_receipt from storage",
     *      tags={"Voucher_upload_receipt"},
     *      description="Delete Voucher_upload_receipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_upload_receipt",
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
        /** @var Voucher_upload_receipt $voucherUploadReceipt */
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            return $this->sendError('Voucher Upload Receipt not found');
        }

        $voucherUploadReceipt->delete();

        return $this->sendSuccess('Voucher Upload Receipt deleted successfully');
    }
}
