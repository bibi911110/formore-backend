<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Offer_banner;

class Offer_bannerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/offer_banners', $offerBanner
        );

        $this->assertApiResponse($offerBanner);
    }

    /**
     * @test
     */
    public function test_read_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/offer_banners/'.$offerBanner->id
        );

        $this->assertApiResponse($offerBanner->toArray());
    }

    /**
     * @test
     */
    public function test_update_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();
        $editedOffer_banner = factory(Offer_banner::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/offer_banners/'.$offerBanner->id,
            $editedOffer_banner
        );

        $this->assertApiResponse($editedOffer_banner);
    }

    /**
     * @test
     */
    public function test_delete_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/offer_banners/'.$offerBanner->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/offer_banners/'.$offerBanner->id
        );

        $this->response->assertStatus(404);
    }
}
