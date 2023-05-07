<?php namespace Tests\Repositories;

use App\Models\Link_master;
use App\Repositories\Link_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Link_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Link_masterRepository
     */
    protected $linkMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->linkMasterRepo = \App::make(Link_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_link_master()
    {
        $linkMaster = factory(Link_master::class)->make()->toArray();

        $createdLink_master = $this->linkMasterRepo->create($linkMaster);

        $createdLink_master = $createdLink_master->toArray();
        $this->assertArrayHasKey('id', $createdLink_master);
        $this->assertNotNull($createdLink_master['id'], 'Created Link_master must have id specified');
        $this->assertNotNull(Link_master::find($createdLink_master['id']), 'Link_master with given id must be in DB');
        $this->assertModelData($linkMaster, $createdLink_master);
    }

    /**
     * @test read
     */
    public function test_read_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();

        $dbLink_master = $this->linkMasterRepo->find($linkMaster->id);

        $dbLink_master = $dbLink_master->toArray();
        $this->assertModelData($linkMaster->toArray(), $dbLink_master);
    }

    /**
     * @test update
     */
    public function test_update_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();
        $fakeLink_master = factory(Link_master::class)->make()->toArray();

        $updatedLink_master = $this->linkMasterRepo->update($fakeLink_master, $linkMaster->id);

        $this->assertModelData($fakeLink_master, $updatedLink_master->toArray());
        $dbLink_master = $this->linkMasterRepo->find($linkMaster->id);
        $this->assertModelData($fakeLink_master, $dbLink_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_link_master()
    {
        $linkMaster = factory(Link_master::class)->create();

        $resp = $this->linkMasterRepo->delete($linkMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Link_master::find($linkMaster->id), 'Link_master should not exist in DB');
    }
}
