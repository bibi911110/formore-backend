<?php namespace Tests\Repositories;

use App\Models\Marketplace_logo;
use App\Repositories\Marketplace_logoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Marketplace_logoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Marketplace_logoRepository
     */
    protected $marketplaceLogoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->marketplaceLogoRepo = \App::make(Marketplace_logoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->make()->toArray();

        $createdMarketplace_logo = $this->marketplaceLogoRepo->create($marketplaceLogo);

        $createdMarketplace_logo = $createdMarketplace_logo->toArray();
        $this->assertArrayHasKey('id', $createdMarketplace_logo);
        $this->assertNotNull($createdMarketplace_logo['id'], 'Created Marketplace_logo must have id specified');
        $this->assertNotNull(Marketplace_logo::find($createdMarketplace_logo['id']), 'Marketplace_logo with given id must be in DB');
        $this->assertModelData($marketplaceLogo, $createdMarketplace_logo);
    }

    /**
     * @test read
     */
    public function test_read_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();

        $dbMarketplace_logo = $this->marketplaceLogoRepo->find($marketplaceLogo->id);

        $dbMarketplace_logo = $dbMarketplace_logo->toArray();
        $this->assertModelData($marketplaceLogo->toArray(), $dbMarketplace_logo);
    }

    /**
     * @test update
     */
    public function test_update_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();
        $fakeMarketplace_logo = factory(Marketplace_logo::class)->make()->toArray();

        $updatedMarketplace_logo = $this->marketplaceLogoRepo->update($fakeMarketplace_logo, $marketplaceLogo->id);

        $this->assertModelData($fakeMarketplace_logo, $updatedMarketplace_logo->toArray());
        $dbMarketplace_logo = $this->marketplaceLogoRepo->find($marketplaceLogo->id);
        $this->assertModelData($fakeMarketplace_logo, $dbMarketplace_logo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_marketplace_logo()
    {
        $marketplaceLogo = factory(Marketplace_logo::class)->create();

        $resp = $this->marketplaceLogoRepo->delete($marketplaceLogo->id);

        $this->assertTrue($resp);
        $this->assertNull(Marketplace_logo::find($marketplaceLogo->id), 'Marketplace_logo should not exist in DB');
    }
}
