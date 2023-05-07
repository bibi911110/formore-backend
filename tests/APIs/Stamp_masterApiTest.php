<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Stamp_master;

class Stamp_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stamp_masters', $stampMaster
        );

        $this->assertApiResponse($stampMaster);
    }

    /**
     * @test
     */
    public function test_read_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/stamp_masters/'.$stampMaster->id
        );

        $this->assertApiResponse($stampMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();
        $editedStamp_master = factory(Stamp_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stamp_masters/'.$stampMaster->id,
            $editedStamp_master
        );

        $this->assertApiResponse($editedStamp_master);
    }

    /**
     * @test
     */
    public function test_delete_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stamp_masters/'.$stampMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stamp_masters/'.$stampMaster->id
        );

        $this->response->assertStatus(404);
    }
}
