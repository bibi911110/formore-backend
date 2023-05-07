<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Points_master;

class Points_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_points_master()
    {
        $pointsMaster = factory(Points_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/points_masters', $pointsMaster
        );

        $this->assertApiResponse($pointsMaster);
    }

    /**
     * @test
     */
    public function test_read_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/points_masters/'.$pointsMaster->id
        );

        $this->assertApiResponse($pointsMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();
        $editedPoints_master = factory(Points_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/points_masters/'.$pointsMaster->id,
            $editedPoints_master
        );

        $this->assertApiResponse($editedPoints_master);
    }

    /**
     * @test
     */
    public function test_delete_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/points_masters/'.$pointsMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/points_masters/'.$pointsMaster->id
        );

        $this->response->assertStatus(404);
    }
}
