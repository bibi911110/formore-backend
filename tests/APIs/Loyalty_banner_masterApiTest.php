<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Loyalty_banner_master;

class Loyalty_banner_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/loyalty_banner_masters', $loyaltyBannerMaster
        );

        $this->assertApiResponse($loyaltyBannerMaster);
    }

    /**
     * @test
     */
    public function test_read_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/loyalty_banner_masters/'.$loyaltyBannerMaster->id
        );

        $this->assertApiResponse($loyaltyBannerMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();
        $editedLoyalty_banner_master = factory(Loyalty_banner_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/loyalty_banner_masters/'.$loyaltyBannerMaster->id,
            $editedLoyalty_banner_master
        );

        $this->assertApiResponse($editedLoyalty_banner_master);
    }

    /**
     * @test
     */
    public function test_delete_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/loyalty_banner_masters/'.$loyaltyBannerMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/loyalty_banner_masters/'.$loyaltyBannerMaster->id
        );

        $this->response->assertStatus(404);
    }
}
