<?php namespace Tests\Repositories;

use App\Models\Holiday_master;
use App\Repositories\Holiday_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Holiday_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Holiday_masterRepository
     */
    protected $holidayMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->holidayMasterRepo = \App::make(Holiday_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->make()->toArray();

        $createdHoliday_master = $this->holidayMasterRepo->create($holidayMaster);

        $createdHoliday_master = $createdHoliday_master->toArray();
        $this->assertArrayHasKey('id', $createdHoliday_master);
        $this->assertNotNull($createdHoliday_master['id'], 'Created Holiday_master must have id specified');
        $this->assertNotNull(Holiday_master::find($createdHoliday_master['id']), 'Holiday_master with given id must be in DB');
        $this->assertModelData($holidayMaster, $createdHoliday_master);
    }

    /**
     * @test read
     */
    public function test_read_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();

        $dbHoliday_master = $this->holidayMasterRepo->find($holidayMaster->id);

        $dbHoliday_master = $dbHoliday_master->toArray();
        $this->assertModelData($holidayMaster->toArray(), $dbHoliday_master);
    }

    /**
     * @test update
     */
    public function test_update_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();
        $fakeHoliday_master = factory(Holiday_master::class)->make()->toArray();

        $updatedHoliday_master = $this->holidayMasterRepo->update($fakeHoliday_master, $holidayMaster->id);

        $this->assertModelData($fakeHoliday_master, $updatedHoliday_master->toArray());
        $dbHoliday_master = $this->holidayMasterRepo->find($holidayMaster->id);
        $this->assertModelData($fakeHoliday_master, $dbHoliday_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_holiday_master()
    {
        $holidayMaster = factory(Holiday_master::class)->create();

        $resp = $this->holidayMasterRepo->delete($holidayMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Holiday_master::find($holidayMaster->id), 'Holiday_master should not exist in DB');
    }
}
