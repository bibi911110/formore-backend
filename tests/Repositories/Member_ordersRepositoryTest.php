<?php namespace Tests\Repositories;

use App\Models\Member_orders;
use App\Repositories\Member_ordersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Member_ordersRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Member_ordersRepository
     */
    protected $memberOrdersRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->memberOrdersRepo = \App::make(Member_ordersRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->make()->toArray();

        $createdMember_orders = $this->memberOrdersRepo->create($memberOrders);

        $createdMember_orders = $createdMember_orders->toArray();
        $this->assertArrayHasKey('id', $createdMember_orders);
        $this->assertNotNull($createdMember_orders['id'], 'Created Member_orders must have id specified');
        $this->assertNotNull(Member_orders::find($createdMember_orders['id']), 'Member_orders with given id must be in DB');
        $this->assertModelData($memberOrders, $createdMember_orders);
    }

    /**
     * @test read
     */
    public function test_read_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();

        $dbMember_orders = $this->memberOrdersRepo->find($memberOrders->id);

        $dbMember_orders = $dbMember_orders->toArray();
        $this->assertModelData($memberOrders->toArray(), $dbMember_orders);
    }

    /**
     * @test update
     */
    public function test_update_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();
        $fakeMember_orders = factory(Member_orders::class)->make()->toArray();

        $updatedMember_orders = $this->memberOrdersRepo->update($fakeMember_orders, $memberOrders->id);

        $this->assertModelData($fakeMember_orders, $updatedMember_orders->toArray());
        $dbMember_orders = $this->memberOrdersRepo->find($memberOrders->id);
        $this->assertModelData($fakeMember_orders, $dbMember_orders->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();

        $resp = $this->memberOrdersRepo->delete($memberOrders->id);

        $this->assertTrue($resp);
        $this->assertNull(Member_orders::find($memberOrders->id), 'Member_orders should not exist in DB');
    }
}
