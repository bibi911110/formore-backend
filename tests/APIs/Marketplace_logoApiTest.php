<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Marketplace_logo;

class Marketplace_logoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/marketplace_logos', $marketplaceLogo
        );

        $this->assertApiResponse($marketplaceLogo);
    }

    /**
     * @test
     */
    public function test_read_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/marketplace_logos/'.$marketplaceLogo->id
        );

        $this->assertApiResponse($marketplaceLogo->toArray());
    }

    /**
     * @test
     */
    public function test_update_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();
        $editedMarketplace_logo = factory(Marketplace_logo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/marketplace_logos/'.$marketplaceLogo->id,
            $editedMarketplace_logo
        );

        $this->assertApiResponse($editedMarketplace_logo);
    }

    /**
     * @test
     */
    public function test_delete_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/marketplace_logos/'.$marketplaceLogo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/marketplace_logos/'.$marketplaceLogo->id
        );

        $this->response->assertStatus(404);
    }
}
