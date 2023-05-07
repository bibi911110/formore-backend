<?php namespace Tests\Repositories;

use App\Models\Tutorial_master;
use App\Repositories\Tutorial_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Tutorial_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Tutorial_masterRepository
     */
    protected $tutorialMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tutorialMasterRepo = \App::make(Tutorial_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->make()->toArray();

        $createdTutorial_master = $this->tutorialMasterRepo->create($tutorialMaster);

        $createdTutorial_master = $createdTutorial_master->toArray();
        $this->assertArrayHasKey('id', $createdTutorial_master);
        $this->assertNotNull($createdTutorial_master['id'], 'Created Tutorial_master must have id specified');
        $this->assertNotNull(Tutorial_master::find($createdTutorial_master['id']), 'Tutorial_master with given id must be in DB');
        $this->assertModelData($tutorialMaster, $createdTutorial_master);
    }

    /**
     * @test read
     */
    public function test_read_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();

        $dbTutorial_master = $this->tutorialMasterRepo->find($tutorialMaster->id);

        $dbTutorial_master = $dbTutorial_master->toArray();
        $this->assertModelData($tutorialMaster->toArray(), $dbTutorial_master);
    }

    /**
     * @test update
     */
    public function test_update_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();
        $fakeTutorial_master = factory(Tutorial_master::class)->make()->toArray();

        $updatedTutorial_master = $this->tutorialMasterRepo->update($fakeTutorial_master, $tutorialMaster->id);

        $this->assertModelData($fakeTutorial_master, $updatedTutorial_master->toArray());
        $dbTutorial_master = $this->tutorialMasterRepo->find($tutorialMaster->id);
        $this->assertModelData($fakeTutorial_master, $dbTutorial_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();

        $resp = $this->tutorialMasterRepo->delete($tutorialMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Tutorial_master::find($tutorialMaster->id), 'Tutorial_master should not exist in DB');
    }
}
