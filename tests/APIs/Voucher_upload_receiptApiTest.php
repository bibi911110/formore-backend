<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Voucher_upload_receipt;

class Voucher_upload_receiptApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/voucher_upload_receipts', $voucherUploadReceipt
        );

        $this->assertApiResponse($voucherUploadReceipt);
    }

    /**
     * @test
     */
    public function test_read_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/voucher_upload_receipts/'.$voucherUploadReceipt->id
        );

        $this->assertApiResponse($voucherUploadReceipt->toArray());
    }

    /**
     * @test
     */
    public function test_update_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();
        $editedVoucher_upload_receipt = factory(Voucher_upload_receipt::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/voucher_upload_receipts/'.$voucherUploadReceipt->id,
            $editedVoucher_upload_receipt
        );

        $this->assertApiResponse($editedVoucher_upload_receipt);
    }

    /**
     * @test
     */
    public function test_delete_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/voucher_upload_receipts/'.$voucherUploadReceipt->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/voucher_upload_receipts/'.$voucherUploadReceipt->id
        );

        $this->response->assertStatus(404);
    }
}
