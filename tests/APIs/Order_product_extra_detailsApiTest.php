<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Order_product_extra_details;

class Order_product_extra_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_product_extra_details', $orderProductExtraDetails
        );

        $this->assertApiResponse($orderProductExtraDetails);
    }

    /**
     * @test
     */
    public function test_read_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_product_extra_details/'.$orderProductExtraDetails->id
        );

        $this->assertApiResponse($orderProductExtraDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();
        $editedOrder_product_extra_details = factory(Order_product_extra_details::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_product_extra_details/'.$orderProductExtraDetails->id,
            $editedOrder_product_extra_details
        );

        $this->assertApiResponse($editedOrder_product_extra_details);
    }

    /**
     * @test
     */
    public function test_delete_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_product_extra_details/'.$orderProductExtraDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_product_extra_details/'.$orderProductExtraDetails->id
        );

        $this->response->assertStatus(404);
    }
}
