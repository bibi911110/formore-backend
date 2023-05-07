<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Refer_business_details;

class Refer_business_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/refer_business_details', $referBusinessDetails
        );

        $this->assertApiResponse($referBusinessDetails);
    }

    /**
     * @test
     */
    public function test_read_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/refer_business_details/'.$referBusinessDetails->id
        );

        $this->assertApiResponse($referBusinessDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();
        $editedRefer_business_details = factory(Refer_business_details::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/refer_business_details/'.$referBusinessDetails->id,
            $editedRefer_business_details
        );

        $this->assertApiResponse($editedRefer_business_details);
    }

    /**
     * @test
     */
    public function test_delete_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/refer_business_details/'.$referBusinessDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/refer_business_details/'.$referBusinessDetails->id
        );

        $this->response->assertStatus(404);
    }
}
