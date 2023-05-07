<?php namespace Tests\Repositories;

use App\Models\Nfc_master;
use App\Repositories\Nfc_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Nfc_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Nfc_masterRepository
     */
    protected $nfcMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nfcMasterRepo = \App::make(Nfc_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->make()->toArray();

        $createdNfc_master = $this->nfcMasterRepo->create($nfcMaster);

        $createdNfc_master = $createdNfc_master->toArray();
        $this->assertArrayHasKey('id', $createdNfc_master);
        $this->assertNotNull($createdNfc_master['id'], 'Created Nfc_master must have id specified');
        $this->assertNotNull(Nfc_master::find($createdNfc_master['id']), 'Nfc_master with given id must be in DB');
        $this->assertModelData($nfcMaster, $createdNfc_master);
    }

    /**
     * @test read
     */
    public function test_read_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();

        $dbNfc_master = $this->nfcMasterRepo->find($nfcMaster->id);

        $dbNfc_master = $dbNfc_master->toArray();
        $this->assertModelData($nfcMaster->toArray(), $dbNfc_master);
    }

    /**
     * @test update
     */
    public function test_update_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();
        $fakeNfc_master = factory(Nfc_master::class)->make()->toArray();

        $updatedNfc_master = $this->nfcMasterRepo->update($fakeNfc_master, $nfcMaster->id);

        $this->assertModelData($fakeNfc_master, $updatedNfc_master->toArray());
        $dbNfc_master = $this->nfcMasterRepo->find($nfcMaster->id);
        $this->assertModelData($fakeNfc_master, $dbNfc_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();

        $resp = $this->nfcMasterRepo->delete($nfcMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Nfc_master::find($nfcMaster->id), 'Nfc_master should not exist in DB');
    }
}
