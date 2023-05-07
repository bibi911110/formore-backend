<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Services_product;

class Services_productApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_services_product()
    {
        $servicesProduct = factory(Services_product::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/services_products', $servicesProduct
        );

        $this->assertApiResponse($servicesProduct);
    }

    /**
     * @test
     */
    public function test_read_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/services_products/'.$servicesProduct->id
        );

        $this->assertApiResponse($servicesProduct->toArray());
    }

    /**
     * @test
     */
    public function test_update_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();
        $editedServices_product = factory(Services_product::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/services_products/'.$servicesProduct->id,
            $editedServices_product
        );

        $this->assertApiResponse($editedServices_product);
    }

    /**
     * @test
     */
    public function test_delete_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/services_products/'.$servicesProduct->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/services_products/'.$servicesProduct->id
        );

        $this->response->assertStatus(404);
    }
}
