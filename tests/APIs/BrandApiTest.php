<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Brand;

class BrandApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_brand()
    {
        $brand = factory(Brand::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/brands', $brand
        );

        $this->assertApiResponse($brand);
    }

    /**
     * @test
     */
    public function test_read_brand()
    {
        $brand = factory(Brand::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/brands/'.$brand->id
        );

        $this->assertApiResponse($brand->toArray());
    }

    /**
     * @test
     */
    public function test_update_brand()
    {
        $brand = factory(Brand::class)->create();
        $editedBrand = factory(Brand::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/brands/'.$brand->id,
            $editedBrand
        );

        $this->assertApiResponse($editedBrand);
    }

    /**
     * @test
     */
    public function test_delete_brand()
    {
        $brand = factory(Brand::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/brands/'.$brand->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/brands/'.$brand->id
        );

        $this->response->assertStatus(404);
    }
}
