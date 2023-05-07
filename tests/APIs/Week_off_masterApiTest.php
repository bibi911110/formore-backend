<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Week_off_master;

class Week_off_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/week_off_masters', $weekOffMaster
        );

        $this->assertApiResponse($weekOffMaster);
    }

    /**
     * @test
     */
    public function test_read_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/week_off_masters/'.$weekOffMaster->id
        );

        $this->assertApiResponse($weekOffMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();
        $editedWeek_off_master = factory(Week_off_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/week_off_masters/'.$weekOffMaster->id,
            $editedWeek_off_master
        );

        $this->assertApiResponse($editedWeek_off_master);
    }

    /**
     * @test
     */
    public function test_delete_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/week_off_masters/'.$weekOffMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/week_off_masters/'.$weekOffMaster->id
        );

        $this->response->assertStatus(404);
    }
}
