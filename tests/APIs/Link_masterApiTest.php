<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Link_master;

class Link_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_link_master()
    {
        $linkMaster = factory(Link_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/link_masters', $linkMaster
        );

        $this->assertApiResponse($linkMaster);
    }

    /**
     * @test
     */
    public function test_read_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/link_masters/'.$linkMaster->id
        );

        $this->assertApiResponse($linkMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();
        $editedLink_master = factory(Link_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/link_masters/'.$linkMaster->id,
            $editedLink_master
        );

        $this->assertApiResponse($editedLink_master);
    }

    /**
     * @test
     */
    public function test_delete_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/link_masters/'.$linkMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/link_masters/'.$linkMaster->id
        );

        $this->response->assertStatus(404);
    }
}
