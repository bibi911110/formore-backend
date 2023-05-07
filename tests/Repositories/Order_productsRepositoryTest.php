<?php namespace Tests\Repositories;

use App\Models\Order_products;
use App\Repositories\Order_productsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Order_productsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Order_productsRepository
     */
    protected $orderProductsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderProductsRepo = \App::make(Order_productsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_products()
    {
        $orderProducts = factory(Order_products::class)->make()->toArray();

        $createdOrder_products = $this->orderProductsRepo->create($orderProducts);

        $createdOrder_products = $createdOrder_products->toArray();
        $this->assertArrayHasKey('id', $createdOrder_products);
        $this->assertNotNull($createdOrder_products['id'], 'Created Order_products must have id specified');
        $this->assertNotNull(Order_products::find($createdOrder_products['id']), 'Order_products with given id must be in DB');
        $this->assertModelData($orderProducts, $createdOrder_products);
    }

    /**
     * @test read
     */
    public function test_read_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();

        $dbOrder_products = $this->orderProductsRepo->find($orderProducts->id);

        $dbOrder_products = $dbOrder_products->toArray();
        $this->assertModelData($orderProducts->toArray(), $dbOrder_products);
    }

    /**
     * @test update
     */
    public function test_update_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();
        $fakeOrder_products = factory(Order_products::class)->make()->toArray();

        $updatedOrder_products = $this->orderProductsRepo->update($fakeOrder_products, $orderProducts->id);

        $this->assertModelData($fakeOrder_products, $updatedOrder_products->toArray());
        $dbOrder_products = $this->orderProductsRepo->find($orderProducts->id);
        $this->assertModelData($fakeOrder_products, $dbOrder_products->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_products()
    {
        $orderProducts = factory(Order_products::class)->create();

        $resp = $this->orderProductsRepo->delete($orderProducts->id);

        $this->assertTrue($resp);
        $this->assertNull(Order_products::find($orderProducts->id), 'Order_products should not exist in DB');
    }
}
