<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Member_orders;

class Member_ordersApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/member_orders', $memberOrders
        );

        $this->assertApiResponse($memberOrders);
    }

    /**
     * @test
     */
    public function test_read_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/member_orders/'.$memberOrders->id
        );

        $this->assertApiResponse($memberOrders->toArray());
    }

    /**
     * @test
     */
    public function test_update_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();
        $editedMember_orders = factory(Member_orders::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/member_orders/'.$memberOrders->id,
            $editedMember_orders
        );

        $this->assertApiResponse($editedMember_orders);
    }

    /**
     * @test
     */
    public function test_delete_member_orders()
    {
        $memberOrders = factory(Member_orders::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/member_orders/'.$memberOrders->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/member_orders/'.$memberOrders->id
        );

        $this->response->assertStatus(404);
    }
}
