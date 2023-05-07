<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Promotional_image_master;

class Promotional_image_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/promotional_image_masters', $promotionalImageMaster
        );

        $this->assertApiResponse($promotionalImageMaster);
    }

    /**
     * @test
     */
    public function test_read_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/promotional_image_masters/'.$promotionalImageMaster->id
        );

        $this->assertApiResponse($promotionalImageMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();
        $editedPromotional_image_master = factory(Promotional_image_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/promotional_image_masters/'.$promotionalImageMaster->id,
            $editedPromotional_image_master
        );

        $this->assertApiResponse($editedPromotional_image_master);
    }

    /**
     * @test
     */
    public function test_delete_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/promotional_image_masters/'.$promotionalImageMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/promotional_image_masters/'.$promotionalImageMaster->id
        );

        $this->response->assertStatus(404);
    }
}
