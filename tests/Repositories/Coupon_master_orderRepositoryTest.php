<?php namespace Tests\Repositories;

use App\Models\Coupon_master_order;
use App\Repositories\Coupon_master_orderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Coupon_master_orderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Coupon_master_orderRepository
     */
    protected $couponMasterOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->couponMasterOrderRepo = \App::make(Coupon_master_orderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->make()->toArray();

        $createdCoupon_master_order = $this->couponMasterOrderRepo->create($couponMasterOrder);

        $createdCoupon_master_order = $createdCoupon_master_order->toArray();
        $this->assertArrayHasKey('id', $createdCoupon_master_order);
        $this->assertNotNull($createdCoupon_master_order['id'], 'Created Coupon_master_order must have id specified');
        $this->assertNotNull(Coupon_master_order::find($createdCoupon_master_order['id']), 'Coupon_master_order with given id must be in DB');
        $this->assertModelData($couponMasterOrder, $createdCoupon_master_order);
    }

    /**
     * @test read
     */
    public function test_read_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();

        $dbCoupon_master_order = $this->couponMasterOrderRepo->find($couponMasterOrder->id);

        $dbCoupon_master_order = $dbCoupon_master_order->toArray();
        $this->assertModelData($couponMasterOrder->toArray(), $dbCoupon_master_order);
    }

    /**
     * @test update
     */
    public function test_update_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();
        $fakeCoupon_master_order = factory(Coupon_master_order::class)->make()->toArray();

        $updatedCoupon_master_order = $this->couponMasterOrderRepo->update($fakeCoupon_master_order, $couponMasterOrder->id);

        $this->assertModelData($fakeCoupon_master_order, $updatedCoupon_master_order->toArray());
        $dbCoupon_master_order = $this->couponMasterOrderRepo->find($couponMasterOrder->id);
        $this->assertModelData($fakeCoupon_master_order, $dbCoupon_master_order->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();

        $resp = $this->couponMasterOrderRepo->delete($couponMasterOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(Coupon_master_order::find($couponMasterOrder->id), 'Coupon_master_order should not exist in DB');
    }
}
