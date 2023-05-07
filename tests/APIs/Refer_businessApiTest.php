<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Refer_business;

class Refer_businessApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/refer_businesses', $referBusiness
        );

        $this->assertApiResponse($referBusiness);
    }

    /**
     * @test
     */
    public function test_read_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/refer_businesses/'.$referBusiness->id
        );

        $this->assertApiResponse($referBusiness->toArray());
    }

    /**
     * @test
     */
    public function test_update_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();
        $editedRefer_business = factory(Refer_business::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/refer_businesses/'.$referBusiness->id,
            $editedRefer_business
        );

        $this->assertApiResponse($editedRefer_business);
    }

    /**
     * @test
     */
    public function test_delete_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/refer_businesses/'.$referBusiness->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/refer_businesses/'.$referBusiness->id
        );

        $this->response->assertStatus(404);
    }
}
