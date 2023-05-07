<?php namespace Tests\Repositories;

use App\Models\Voucher_upload_receipt;
use App\Repositories\Voucher_upload_receiptRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Voucher_upload_receiptRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Voucher_upload_receiptRepository
     */
    protected $voucherUploadReceiptRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->voucherUploadReceiptRepo = \App::make(Voucher_upload_receiptRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->make()->toArray();

        $createdVoucher_upload_receipt = $this->voucherUploadReceiptRepo->create($voucherUploadReceipt);

        $createdVoucher_upload_receipt = $createdVoucher_upload_receipt->toArray();
        $this->assertArrayHasKey('id', $createdVoucher_upload_receipt);
        $this->assertNotNull($createdVoucher_upload_receipt['id'], 'Created Voucher_upload_receipt must have id specified');
        $this->assertNotNull(Voucher_upload_receipt::find($createdVoucher_upload_receipt['id']), 'Voucher_upload_receipt with given id must be in DB');
        $this->assertModelData($voucherUploadReceipt, $createdVoucher_upload_receipt);
    }

    /**
     * @test read
     */
    public function test_read_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();

        $dbVoucher_upload_receipt = $this->voucherUploadReceiptRepo->find($voucherUploadReceipt->id);

        $dbVoucher_upload_receipt = $dbVoucher_upload_receipt->toArray();
        $this->assertModelData($voucherUploadReceipt->toArray(), $dbVoucher_upload_receipt);
    }

    /**
     * @test update
     */
    public function test_update_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();
        $fakeVoucher_upload_receipt = factory(Voucher_upload_receipt::class)->make()->toArray();

        $updatedVoucher_upload_receipt = $this->voucherUploadReceiptRepo->update($fakeVoucher_upload_receipt, $voucherUploadReceipt->id);

        $this->assertModelData($fakeVoucher_upload_receipt, $updatedVoucher_upload_receipt->toArray());
        $dbVoucher_upload_receipt = $this->voucherUploadReceiptRepo->find($voucherUploadReceipt->id);
        $this->assertModelData($fakeVoucher_upload_receipt, $dbVoucher_upload_receipt->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_voucher_upload_receipt()
    {
        $voucherUploadReceipt = factory(Voucher_upload_receipt::class)->create();

        $resp = $this->voucherUploadReceiptRepo->delete($voucherUploadReceipt->id);

        $this->assertTrue($resp);
        $this->assertNull(Voucher_upload_receipt::find($voucherUploadReceipt->id), 'Voucher_upload_receipt should not exist in DB');
    }
}
