<?php namespace Tests\Repositories;

use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VoucherRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VoucherRepository
     */
    protected $voucherRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->voucherRepo = \App::make(VoucherRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_voucher()
    {
        $voucher = factory(Voucher::class)->make()->toArray();

        $createdVoucher = $this->voucherRepo->create($voucher);

        $createdVoucher = $createdVoucher->toArray();
        $this->assertArrayHasKey('id', $createdVoucher);
        $this->assertNotNull($createdVoucher['id'], 'Created Voucher must have id specified');
        $this->assertNotNull(Voucher::find($createdVoucher['id']), 'Voucher with given id must be in DB');
        $this->assertModelData($voucher, $createdVoucher);
    }

    /**
     * @test read
     */
    public function test_read_voucher()
    {
        $voucher = factory(Voucher::class)->create();

        $dbVoucher = $this->voucherRepo->find($voucher->id);

        $dbVoucher = $dbVoucher->toArray();
        $this->assertModelData($voucher->toArray(), $dbVoucher);
    }

    /**
     * @test update
     */
    public function test_update_voucher()
    {
        $voucher = factory(Voucher::class)->create();
        $fakeVoucher = factory(Voucher::class)->make()->toArray();

        $updatedVoucher = $this->voucherRepo->update($fakeVoucher, $voucher->id);

        $this->assertModelData($fakeVoucher, $updatedVoucher->toArray());
        $dbVoucher = $this->voucherRepo->find($voucher->id);
        $this->assertModelData($fakeVoucher, $dbVoucher->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_voucher()
    {
        $voucher = factory(Voucher::class)->create();

        $resp = $this->voucherRepo->delete($voucher->id);

        $this->assertTrue($resp);
        $this->assertNull(Voucher::find($voucher->id), 'Voucher should not exist in DB');
    }
}
