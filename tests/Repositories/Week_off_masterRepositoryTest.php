<?php namespace Tests\Repositories;

use App\Models\Week_off_master;
use App\Repositories\Week_off_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Week_off_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Week_off_masterRepository
     */
    protected $weekOffMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->weekOffMasterRepo = \App::make(Week_off_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->make()->toArray();

        $createdWeek_off_master = $this->weekOffMasterRepo->create($weekOffMaster);

        $createdWeek_off_master = $createdWeek_off_master->toArray();
        $this->assertArrayHasKey('id', $createdWeek_off_master);
        $this->assertNotNull($createdWeek_off_master['id'], 'Created Week_off_master must have id specified');
        $this->assertNotNull(Week_off_master::find($createdWeek_off_master['id']), 'Week_off_master with given id must be in DB');
        $this->assertModelData($weekOffMaster, $createdWeek_off_master);
    }

    /**
     * @test read
     */
    public function test_read_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();

        $dbWeek_off_master = $this->weekOffMasterRepo->find($weekOffMaster->id);

        $dbWeek_off_master = $dbWeek_off_master->toArray();
        $this->assertModelData($weekOffMaster->toArray(), $dbWeek_off_master);
    }

    /**
     * @test update
     */
    public function test_update_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();
        $fakeWeek_off_master = factory(Week_off_master::class)->make()->toArray();

        $updatedWeek_off_master = $this->weekOffMasterRepo->update($fakeWeek_off_master, $weekOffMaster->id);

        $this->assertModelData($fakeWeek_off_master, $updatedWeek_off_master->toArray());
        $dbWeek_off_master = $this->weekOffMasterRepo->find($weekOffMaster->id);
        $this->assertModelData($fakeWeek_off_master, $dbWeek_off_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_week_off_master()
    {
        $weekOffMaster = factory(Week_off_master::class)->create();

        $resp = $this->weekOffMasterRepo->delete($weekOffMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Week_off_master::find($weekOffMaster->id), 'Week_off_master should not exist in DB');
    }
}
