<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Faqs_business;

class Faqs_businessApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/faqs_businesses', $faqsBusiness
        );

        $this->assertApiResponse($faqsBusiness);
    }

    /**
     * @test
     */
    public function test_read_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/faqs_businesses/'.$faqsBusiness->id
        );

        $this->assertApiResponse($faqsBusiness->toArray());
    }

    /**
     * @test
     */
    public function test_update_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();
        $editedFaqs_business = factory(Faqs_business::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/faqs_businesses/'.$faqsBusiness->id,
            $editedFaqs_business
        );

        $this->assertApiResponse($editedFaqs_business);
    }

    /**
     * @test
     */
    public function test_delete_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/faqs_businesses/'.$faqsBusiness->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/faqs_businesses/'.$faqsBusiness->id
        );

        $this->response->assertStatus(404);
    }
}
