<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Order_products;

class Order_productsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_products()
    {
        $orderProducts = factory(Order_products::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_products', $orderProducts
        );

        $this->assertApiResponse($orderProducts);
    }

    /**
     * @test
     */
    public function test_read_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_products/'.$orderProducts->id
        );

        $this->assertApiResponse($orderProducts->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();
        $editedOrder_products = factory(Order_products::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_products/'.$orderProducts->id,
            $editedOrder_products
        );

        $this->assertApiResponse($editedOrder_products);
    }

    /**
     * @test
     */
    public function test_delete_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_products/'.$orderProducts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_products/'.$orderProducts->id
        );

        $this->response->assertStatus(404);
    }
}
