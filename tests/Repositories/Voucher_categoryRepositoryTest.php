<?php namespace Tests\Repositories;

use App\Models\Voucher_category;
use App\Repositories\Voucher_categoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Voucher_categoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Voucher_categoryRepository
     */
    protected $voucherCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->voucherCategoryRepo = \App::make(Voucher_categoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->make()->toArray();

        $createdVoucher_category = $this->voucherCategoryRepo->create($voucherCategory);

        $createdVoucher_category = $createdVoucher_category->toArray();
        $this->assertArrayHasKey('id', $createdVoucher_category);
        $this->assertNotNull($createdVoucher_category['id'], 'Created Voucher_category must have id specified');
        $this->assertNotNull(Voucher_category::find($createdVoucher_category['id']), 'Voucher_category with given id must be in DB');
        $this->assertModelData($voucherCategory, $createdVoucher_category);
    }

    /**
     * @test read
     */
    public function test_read_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();

        $dbVoucher_category = $this->voucherCategoryRepo->find($voucherCategory->id);

        $dbVoucher_category = $dbVoucher_category->toArray();
        $this->assertModelData($voucherCategory->toArray(), $dbVoucher_category);
    }

    /**
     * @test update
     */
    public function test_update_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();
        $fakeVoucher_category = factory(Voucher_category::class)->make()->toArray();

        $updatedVoucher_category = $this->voucherCategoryRepo->update($fakeVoucher_category, $voucherCategory->id);

        $this->assertModelData($fakeVoucher_category, $updatedVoucher_category->toArray());
        $dbVoucher_category = $this->voucherCategoryRepo->find($voucherCategory->id);
        $this->assertModelData($fakeVoucher_category, $dbVoucher_category->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();

        $resp = $this->voucherCategoryRepo->delete($voucherCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(Voucher_category::find($voucherCategory->id), 'Voucher_category should not exist in DB');
    }
}
