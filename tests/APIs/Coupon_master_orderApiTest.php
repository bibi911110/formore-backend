<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Coupon_master_order;

class Coupon_master_orderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/coupon_master_orders', $couponMasterOrder
        );

        $this->assertApiResponse($couponMasterOrder);
    }

    /**
     * @test
     */
    public function test_read_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/coupon_master_orders/'.$couponMasterOrder->id
        );

        $this->assertApiResponse($couponMasterOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();
        $editedCoupon_master_order = factory(Coupon_master_order::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/coupon_master_orders/'.$couponMasterOrder->id,
            $editedCoupon_master_order
        );

        $this->assertApiResponse($editedCoupon_master_order);
    }

    /**
     * @test
     */
    public function test_delete_coupon_master_order()
    {
        $couponMasterOrder = factory(Coupon_master_order::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/coupon_master_orders/'.$couponMasterOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/coupon_master_orders/'.$couponMasterOrder->id
        );

        $this->response->assertStatus(404);
    }
}
