<?php namespace Tests\Repositories;

use App\Models\Promotional_image_master;
use App\Repositories\Promotional_image_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Promotional_image_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Promotional_image_masterRepository
     */
    protected $promotionalImageMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->promotionalImageMasterRepo = \App::make(Promotional_image_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->make()->toArray();

        $createdPromotional_image_master = $this->promotionalImageMasterRepo->create($promotionalImageMaster);

        $createdPromotional_image_master = $createdPromotional_image_master->toArray();
        $this->assertArrayHasKey('id', $createdPromotional_image_master);
        $this->assertNotNull($createdPromotional_image_master['id'], 'Created Promotional_image_master must have id specified');
        $this->assertNotNull(Promotional_image_master::find($createdPromotional_image_master['id']), 'Promotional_image_master with given id must be in DB');
        $this->assertModelData($promotionalImageMaster, $createdPromotional_image_master);
    }

    /**
     * @test read
     */
    public function test_read_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();

        $dbPromotional_image_master = $this->promotionalImageMasterRepo->find($promotionalImageMaster->id);

        $dbPromotional_image_master = $dbPromotional_image_master->toArray();
        $this->assertModelData($promotionalImageMaster->toArray(), $dbPromotional_image_master);
    }

    /**
     * @test update
     */
    public function test_update_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();
        $fakePromotional_image_master = factory(Promotional_image_master::class)->make()->toArray();

        $updatedPromotional_image_master = $this->promotionalImageMasterRepo->update($fakePromotional_image_master, $promotionalImageMaster->id);

        $this->assertModelData($fakePromotional_image_master, $updatedPromotional_image_master->toArray());
        $dbPromotional_image_master = $this->promotionalImageMasterRepo->find($promotionalImageMaster->id);
        $this->assertModelData($fakePromotional_image_master, $dbPromotional_image_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_promotional_image_master()
    {
        $promotionalImageMaster = factory(Promotional_image_master::class)->create();

        $resp = $this->promotionalImageMasterRepo->delete($promotionalImageMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Promotional_image_master::find($promotionalImageMaster->id), 'Promotional_image_master should not exist in DB');
    }
}
