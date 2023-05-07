<?php namespace Tests\Repositories;

use App\Models\Offer_banner;
use App\Repositories\Offer_bannerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Offer_bannerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Offer_bannerRepository
     */
    protected $offerBannerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->offerBannerRepo = \App::make(Offer_bannerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->make()->toArray();

        $createdOffer_banner = $this->offerBannerRepo->create($offerBanner);

        $createdOffer_banner = $createdOffer_banner->toArray();
        $this->assertArrayHasKey('id', $createdOffer_banner);
        $this->assertNotNull($createdOffer_banner['id'], 'Created Offer_banner must have id specified');
        $this->assertNotNull(Offer_banner::find($createdOffer_banner['id']), 'Offer_banner with given id must be in DB');
        $this->assertModelData($offerBanner, $createdOffer_banner);
    }

    /**
     * @test read
     */
    public function test_read_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();

        $dbOffer_banner = $this->offerBannerRepo->find($offerBanner->id);

        $dbOffer_banner = $dbOffer_banner->toArray();
        $this->assertModelData($offerBanner->toArray(), $dbOffer_banner);
    }

    /**
     * @test update
     */
    public function test_update_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();
        $fakeOffer_banner = factory(Offer_banner::class)->make()->toArray();

        $updatedOffer_banner = $this->offerBannerRepo->update($fakeOffer_banner, $offerBanner->id);

        $this->assertModelData($fakeOffer_banner, $updatedOffer_banner->toArray());
        $dbOffer_banner = $this->offerBannerRepo->find($offerBanner->id);
        $this->assertModelData($fakeOffer_banner, $dbOffer_banner->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_offer_banner()
    {
        $offerBanner = factory(Offer_banner::class)->create();

        $resp = $this->offerBannerRepo->delete($offerBanner->id);

        $this->assertTrue($resp);
        $this->assertNull(Offer_banner::find($offerBanner->id), 'Offer_banner should not exist in DB');
    }
}
