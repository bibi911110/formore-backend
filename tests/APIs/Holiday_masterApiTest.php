<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Holiday_master;

class Holiday_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/holiday_masters', $holidayMaster
        );

        $this->assertApiResponse($holidayMaster);
    }

    /**
     * @test
     */
    public function test_read_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/holiday_masters/'.$holidayMaster->id
        );

        $this->assertApiResponse($holidayMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();
        $editedHoliday_master = factory(Holiday_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/holiday_masters/'.$holidayMaster->id,
            $editedHoliday_master
        );

        $this->assertApiResponse($editedHoliday_master);
    }

    /**
     * @test
     */
    public function test_delete_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/holiday_masters/'.$holidayMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/holiday_masters/'.$holidayMaster->id
        );

        $this->response->assertStatus(404);
    }
}
