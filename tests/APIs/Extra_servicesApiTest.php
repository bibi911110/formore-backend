<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Extra_services;

class Extra_servicesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_extra_services()
    {
        $extraServices = factory(Extra_services::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/extra_services', $extraServices
        );

        $this->assertApiResponse($extraServices);
    }

    /**
     * @test
     */
    public function test_read_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/extra_services/'.$extraServices->id
        );

        $this->assertApiResponse($extraServices->toArray());
    }

    /**
     * @test
     */
    public function test_update_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();
        $editedExtra_services = factory(Extra_services::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/extra_services/'.$extraServices->id,
            $editedExtra_services
        );

        $this->assertApiResponse($editedExtra_services);
    }

    /**
     * @test
     */
    public function test_delete_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/extra_services/'.$extraServices->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/extra_services/'.$extraServices->id
        );

        $this->response->assertStatus(404);
    }
}
