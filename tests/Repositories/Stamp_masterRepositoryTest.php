<?php namespace Tests\Repositories;

use App\Models\Stamp_master;
use App\Repositories\Stamp_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Stamp_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Stamp_masterRepository
     */
    protected $stampMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stampMasterRepo = \App::make(Stamp_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->make()->toArray();

        $createdStamp_master = $this->stampMasterRepo->create($stampMaster);

        $createdStamp_master = $createdStamp_master->toArray();
        $this->assertArrayHasKey('id', $createdStamp_master);
        $this->assertNotNull($createdStamp_master['id'], 'Created Stamp_master must have id specified');
        $this->assertNotNull(Stamp_master::find($createdStamp_master['id']), 'Stamp_master with given id must be in DB');
        $this->assertModelData($stampMaster, $createdStamp_master);
    }

    /**
     * @test read
     */
    public function test_read_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();

        $dbStamp_master = $this->stampMasterRepo->find($stampMaster->id);

        $dbStamp_master = $dbStamp_master->toArray();
        $this->assertModelData($stampMaster->toArray(), $dbStamp_master);
    }

    /**
     * @test update
     */
    public function test_update_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();
        $fakeStamp_master = factory(Stamp_master::class)->make()->toArray();

        $updatedStamp_master = $this->stampMasterRepo->update($fakeStamp_master, $stampMaster->id);

        $this->assertModelData($fakeStamp_master, $updatedStamp_master->toArray());
        $dbStamp_master = $this->stampMasterRepo->find($stampMaster->id);
        $this->assertModelData($fakeStamp_master, $dbStamp_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stamp_master()
    {
        $stampMaster = factory(Stamp_master::class)->create();

        $resp = $this->stampMasterRepo->delete($stampMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Stamp_master::find($stampMaster->id), 'Stamp_master should not exist in DB');
    }
}
