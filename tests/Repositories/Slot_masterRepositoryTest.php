<?php namespace Tests\Repositories;

use App\Models\Slot_master;
use App\Repositories\Slot_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Slot_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Slot_masterRepository
     */
    protected $slotMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->slotMasterRepo = \App::make(Slot_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_slot_master()
    {
        $slotMaster = factory(Slot_master::class)->make()->toArray();

        $createdSlot_master = $this->slotMasterRepo->create($slotMaster);

        $createdSlot_master = $createdSlot_master->toArray();
        $this->assertArrayHasKey('id', $createdSlot_master);
        $this->assertNotNull($createdSlot_master['id'], 'Created Slot_master must have id specified');
        $this->assertNotNull(Slot_master::find($createdSlot_master['id']), 'Slot_master with given id must be in DB');
        $this->assertModelData($slotMaster, $createdSlot_master);
    }

    /**
     * @test read
     */
    public function test_read_slot_master()
    {
        $slotMaster = factory(Slot_master::class)->create();

        $dbSlot_master = $this->slotMasterRepo->find($slotMaster->id);

        $dbSlot_master = $dbSlot_master->toArray();
        $this->assertModelData($slotMaster->toArray(), $dbSlot_master);
    }

    /**
     * @test update
     */
    public function test_update_slot_master()
    {
        $slotMaster = factory(Slot_master::class)->create();
        $fakeSlot_master = factory(Slot_master::class)->make()->toArray();

        $updatedSlot_master = $this->slotMasterRepo->update($fakeSlot_master, $slotMaster->id);

        $this->assertModelData($fakeSlot_master, $updatedSlot_master->toArray());
        $dbSlot_master = $this->slotMasterRepo->find($slotMaster->id);
        $this->assertModelData($fakeSlot_master, $dbSlot_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_slot_master()
    {
        $slotMaster = factory(Slot_master::class)->create();

        $resp = $this->slotMasterRepo->delete($slotMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Slot_master::find($slotMaster->id), 'Slot_master should not exist in DB');
    }
}
