<?php namespace Tests\Repositories;

use App\Models\Points_master;
use App\Repositories\Points_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Points_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Points_masterRepository
     */
    protected $pointsMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pointsMasterRepo = \App::make(Points_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_points_master()
    {
        $pointsMaster = factory(Points_master::class)->make()->toArray();

        $createdPoints_master = $this->pointsMasterRepo->create($pointsMaster);

        $createdPoints_master = $createdPoints_master->toArray();
        $this->assertArrayHasKey('id', $createdPoints_master);
        $this->assertNotNull($createdPoints_master['id'], 'Created Points_master must have id specified');
        $this->assertNotNull(Points_master::find($createdPoints_master['id']), 'Points_master with given id must be in DB');
        $this->assertModelData($pointsMaster, $createdPoints_master);
    }

    /**
     * @test read
     */
    public function test_read_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();

        $dbPoints_master = $this->pointsMasterRepo->find($pointsMaster->id);

        $dbPoints_master = $dbPoints_master->toArray();
        $this->assertModelData($pointsMaster->toArray(), $dbPoints_master);
    }

    /**
     * @test update
     */
    public function test_update_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();
        $fakePoints_master = factory(Points_master::class)->make()->toArray();

        $updatedPoints_master = $this->pointsMasterRepo->update($fakePoints_master, $pointsMaster->id);

        $this->assertModelData($fakePoints_master, $updatedPoints_master->toArray());
        $dbPoints_master = $this->pointsMasterRepo->find($pointsMaster->id);
        $this->assertModelData($fakePoints_master, $dbPoints_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_points_master()
    {
        $pointsMaster = factory(Points_master::class)->create();

        $resp = $this->pointsMasterRepo->delete($pointsMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Points_master::find($pointsMaster->id), 'Points_master should not exist in DB');
    }
}
