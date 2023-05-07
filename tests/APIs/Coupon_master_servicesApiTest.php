<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Coupon_master_services;

class Coupon_master_servicesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/coupon_master_services', $couponMasterServices
        );

        $this->assertApiResponse($couponMasterServices);
    }

    /**
     * @test
     */
    public function test_read_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/coupon_master_services/'.$couponMasterServices->id
        );

        $this->assertApiResponse($couponMasterServices->toArray());
    }

    /**
     * @test
     */
    public function test_update_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();
        $editedCoupon_master_services = factory(Coupon_master_services::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/coupon_master_services/'.$couponMasterServices->id,
            $editedCoupon_master_services
        );

        $this->assertApiResponse($editedCoupon_master_services);
    }

    /**
     * @test
     */
    public function test_delete_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/coupon_master_services/'.$couponMasterServices->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/coupon_master_services/'.$couponMasterServices->id
        );

        $this->response->assertStatus(404);
    }
}
