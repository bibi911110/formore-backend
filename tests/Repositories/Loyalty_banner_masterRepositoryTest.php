<?php namespace Tests\Repositories;

use App\Models\Loyalty_banner_master;
use App\Repositories\Loyalty_banner_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Loyalty_banner_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Loyalty_banner_masterRepository
     */
    protected $loyaltyBannerMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->loyaltyBannerMasterRepo = \App::make(Loyalty_banner_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->make()->toArray();

        $createdLoyalty_banner_master = $this->loyaltyBannerMasterRepo->create($loyaltyBannerMaster);

        $createdLoyalty_banner_master = $createdLoyalty_banner_master->toArray();
        $this->assertArrayHasKey('id', $createdLoyalty_banner_master);
        $this->assertNotNull($createdLoyalty_banner_master['id'], 'Created Loyalty_banner_master must have id specified');
        $this->assertNotNull(Loyalty_banner_master::find($createdLoyalty_banner_master['id']), 'Loyalty_banner_master with given id must be in DB');
        $this->assertModelData($loyaltyBannerMaster, $createdLoyalty_banner_master);
    }

    /**
     * @test read
     */
    public function test_read_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();

        $dbLoyalty_banner_master = $this->loyaltyBannerMasterRepo->find($loyaltyBannerMaster->id);

        $dbLoyalty_banner_master = $dbLoyalty_banner_master->toArray();
        $this->assertModelData($loyaltyBannerMaster->toArray(), $dbLoyalty_banner_master);
    }

    /**
     * @test update
     */
    public function test_update_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();
        $fakeLoyalty_banner_master = factory(Loyalty_banner_master::class)->make()->toArray();

        $updatedLoyalty_banner_master = $this->loyaltyBannerMasterRepo->update($fakeLoyalty_banner_master, $loyaltyBannerMaster->id);

        $this->assertModelData($fakeLoyalty_banner_master, $updatedLoyalty_banner_master->toArray());
        $dbLoyalty_banner_master = $this->loyaltyBannerMasterRepo->find($loyaltyBannerMaster->id);
        $this->assertModelData($fakeLoyalty_banner_master, $dbLoyalty_banner_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_loyalty_banner_master()
    {
        $loyaltyBannerMaster = factory(Loyalty_banner_master::class)->create();

        $resp = $this->loyaltyBannerMasterRepo->delete($loyaltyBannerMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Loyalty_banner_master::find($loyaltyBannerMaster->id), 'Loyalty_banner_master should not exist in DB');
    }
}
