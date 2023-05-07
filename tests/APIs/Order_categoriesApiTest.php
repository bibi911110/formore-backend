<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Order_categories;

class Order_categoriesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_categories', $orderCategories
        );

        $this->assertApiResponse($orderCategories);
    }

    /**
     * @test
     */
    public function test_read_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_categories/'.$orderCategories->id
        );

        $this->assertApiResponse($orderCategories->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();
        $editedOrder_categories = factory(Order_categories::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_categories/'.$orderCategories->id,
            $editedOrder_categories
        );

        $this->assertApiResponse($editedOrder_categories);
    }

    /**
     * @test
     */
    public function test_delete_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_categories/'.$orderCategories->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_categories/'.$orderCategories->id
        );

        $this->response->assertStatus(404);
    }
}
