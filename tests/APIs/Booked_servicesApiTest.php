<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Booked_services;

class Booked_servicesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/booked_services', $bookedServices
        );

        $this->assertApiResponse($bookedServices);
    }

    /**
     * @test
     */
    public function test_read_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/booked_services/'.$bookedServices->id
        );

        $this->assertApiResponse($bookedServices->toArray());
    }

    /**
     * @test
     */
    public function test_update_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();
        $editedBooked_services = factory(Booked_services::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/booked_services/'.$bookedServices->id,
            $editedBooked_services
        );

        $this->assertApiResponse($editedBooked_services);
    }

    /**
     * @test
     */
    public function test_delete_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/booked_services/'.$bookedServices->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/booked_services/'.$bookedServices->id
        );

        $this->response->assertStatus(404);
    }
}
