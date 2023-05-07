<?php namespace Tests\Repositories;

use App\Models\Order_categories;
use App\Repositories\Order_categoriesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Order_categoriesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Order_categoriesRepository
     */
    protected $orderCategoriesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderCategoriesRepo = \App::make(Order_categoriesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->make()->toArray();

        $createdOrder_categories = $this->orderCategoriesRepo->create($orderCategories);

        $createdOrder_categories = $createdOrder_categories->toArray();
        $this->assertArrayHasKey('id', $createdOrder_categories);
        $this->assertNotNull($createdOrder_categories['id'], 'Created Order_categories must have id specified');
        $this->assertNotNull(Order_categories::find($createdOrder_categories['id']), 'Order_categories with given id must be in DB');
        $this->assertModelData($orderCategories, $createdOrder_categories);
    }

    /**
     * @test read
     */
    public function test_read_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();

        $dbOrder_categories = $this->orderCategoriesRepo->find($orderCategories->id);

        $dbOrder_categories = $dbOrder_categories->toArray();
        $this->assertModelData($orderCategories->toArray(), $dbOrder_categories);
    }

    /**
     * @test update
     */
    public function test_update_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();
        $fakeOrder_categories = factory(Order_categories::class)->make()->toArray();

        $updatedOrder_categories = $this->orderCategoriesRepo->update($fakeOrder_categories, $orderCategories->id);

        $this->assertModelData($fakeOrder_categories, $updatedOrder_categories->toArray());
        $dbOrder_categories = $this->orderCategoriesRepo->find($orderCategories->id);
        $this->assertModelData($fakeOrder_categories, $dbOrder_categories->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_categories()
    {
        $orderCategories = factory(Order_categories::class)->create();

        $resp = $this->orderCategoriesRepo->delete($orderCategories->id);

        $this->assertTrue($resp);
        $this->assertNull(Order_categories::find($orderCategories->id), 'Order_categories should not exist in DB');
    }
}
