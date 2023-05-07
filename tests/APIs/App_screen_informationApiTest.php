<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\App_screen_information;

class App_screen_informationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_screen_informations', $appScreenInformation
        );

        $this->assertApiResponse($appScreenInformation);
    }

    /**
     * @test
     */
    public function test_read_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_screen_informations/'.$appScreenInformation->id
        );

        $this->assertApiResponse($appScreenInformation->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();
        $editedApp_screen_information = factory(App_screen_information::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_screen_informations/'.$appScreenInformation->id,
            $editedApp_screen_information
        );

        $this->assertApiResponse($editedApp_screen_information);
    }

    /**
     * @test
     */
    public function test_delete_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_screen_informations/'.$appScreenInformation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_screen_informations/'.$appScreenInformation->id
        );

        $this->response->assertStatus(404);
    }
}
