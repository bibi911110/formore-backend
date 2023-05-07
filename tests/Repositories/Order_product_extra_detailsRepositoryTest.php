<?php namespace Tests\Repositories;

use App\Models\Order_product_extra_details;
use App\Repositories\Order_product_extra_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Order_product_extra_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Order_product_extra_detailsRepository
     */
    protected $orderProductExtraDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderProductExtraDetailsRepo = \App::make(Order_product_extra_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->make()->toArray();

        $createdOrder_product_extra_details = $this->orderProductExtraDetailsRepo->create($orderProductExtraDetails);

        $createdOrder_product_extra_details = $createdOrder_product_extra_details->toArray();
        $this->assertArrayHasKey('id', $createdOrder_product_extra_details);
        $this->assertNotNull($createdOrder_product_extra_details['id'], 'Created Order_product_extra_details must have id specified');
        $this->assertNotNull(Order_product_extra_details::find($createdOrder_product_extra_details['id']), 'Order_product_extra_details with given id must be in DB');
        $this->assertModelData($orderProductExtraDetails, $createdOrder_product_extra_details);
    }

    /**
     * @test read
     */
    public function test_read_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();

        $dbOrder_product_extra_details = $this->orderProductExtraDetailsRepo->find($orderProductExtraDetails->id);

        $dbOrder_product_extra_details = $dbOrder_product_extra_details->toArray();
        $this->assertModelData($orderProductExtraDetails->toArray(), $dbOrder_product_extra_details);
    }

    /**
     * @test update
     */
    public function test_update_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();
        $fakeOrder_product_extra_details = factory(Order_product_extra_details::class)->make()->toArray();

        $updatedOrder_product_extra_details = $this->orderProductExtraDetailsRepo->update($fakeOrder_product_extra_details, $orderProductExtraDetails->id);

        $this->assertModelData($fakeOrder_product_extra_details, $updatedOrder_product_extra_details->toArray());
        $dbOrder_product_extra_details = $this->orderProductExtraDetailsRepo->find($orderProductExtraDetails->id);
        $this->assertModelData($fakeOrder_product_extra_details, $dbOrder_product_extra_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_product_extra_details()
    {
        $orderProductExtraDetails = factory(Order_product_extra_details::class)->create();

        $resp = $this->orderProductExtraDetailsRepo->delete($orderProductExtraDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(Order_product_extra_details::find($orderProductExtraDetails->id), 'Order_product_extra_details should not exist in DB');
    }
}
