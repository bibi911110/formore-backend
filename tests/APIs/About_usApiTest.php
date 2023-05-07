<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\About_us;

class About_usApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_about_us()
    {
        $aboutUs = factory(About_us::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/about_uses', $aboutUs
        );

        $this->assertApiResponse($aboutUs);
    }

    /**
     * @test
     */
    public function test_read_about_us()
    {
        $aboutUs = factory(About_us::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/about_uses/'.$aboutUs->id
        );

        $this->assertApiResponse($aboutUs->toArray());
    }

    /**
     * @test
     */
    public function test_update_about_us()
    {
        $aboutUs = factory(About_us::class)->create();
        $editedAbout_us = factory(About_us::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/about_uses/'.$aboutUs->id,
            $editedAbout_us
        );

        $this->assertApiResponse($editedAbout_us);
    }

    /**
     * @test
     */
    public function test_delete_about_us()
    {
        $aboutUs = factory(About_us::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/about_uses/'.$aboutUs->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/about_uses/'.$aboutUs->id
        );

        $this->response->assertStatus(404);
    }
}
