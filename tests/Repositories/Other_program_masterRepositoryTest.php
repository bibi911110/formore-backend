<?php namespace Tests\Repositories;

use App\Models\Other_program_master;
use App\Repositories\Other_program_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Other_program_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Other_program_masterRepository
     */
    protected $otherProgramMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->otherProgramMasterRepo = \App::make(Other_program_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->make()->toArray();

        $createdOther_program_master = $this->otherProgramMasterRepo->create($otherProgramMaster);

        $createdOther_program_master = $createdOther_program_master->toArray();
        $this->assertArrayHasKey('id', $createdOther_program_master);
        $this->assertNotNull($createdOther_program_master['id'], 'Created Other_program_master must have id specified');
        $this->assertNotNull(Other_program_master::find($createdOther_program_master['id']), 'Other_program_master with given id must be in DB');
        $this->assertModelData($otherProgramMaster, $createdOther_program_master);
    }

    /**
     * @test read
     */
    public function test_read_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();

        $dbOther_program_master = $this->otherProgramMasterRepo->find($otherProgramMaster->id);

        $dbOther_program_master = $dbOther_program_master->toArray();
        $this->assertModelData($otherProgramMaster->toArray(), $dbOther_program_master);
    }

    /**
     * @test update
     */
    public function test_update_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();
        $fakeOther_program_master = factory(Other_program_master::class)->make()->toArray();

        $updatedOther_program_master = $this->otherProgramMasterRepo->update($fakeOther_program_master, $otherProgramMaster->id);

        $this->assertModelData($fakeOther_program_master, $updatedOther_program_master->toArray());
        $dbOther_program_master = $this->otherProgramMasterRepo->find($otherProgramMaster->id);
        $this->assertModelData($fakeOther_program_master, $dbOther_program_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();

        $resp = $this->otherProgramMasterRepo->delete($otherProgramMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Other_program_master::find($otherProgramMaster->id), 'Other_program_master should not exist in DB');
    }
}
