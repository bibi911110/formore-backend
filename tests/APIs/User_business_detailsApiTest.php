<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\User_business_details;

class User_business_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_business_details', $userBusinessDetails
        );

        $this->assertApiResponse($userBusinessDetails);
    }

    /**
     * @test
     */
    public function test_read_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_business_details/'.$userBusinessDetails->id
        );

        $this->assertApiResponse($userBusinessDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();
        $editedUser_business_details = factory(User_business_details::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_business_details/'.$userBusinessDetails->id,
            $editedUser_business_details
        );

        $this->assertApiResponse($editedUser_business_details);
    }

    /**
     * @test
     */
    public function test_delete_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_business_details/'.$userBusinessDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_business_details/'.$userBusinessDetails->id
        );

        $this->response->assertStatus(404);
    }
}
