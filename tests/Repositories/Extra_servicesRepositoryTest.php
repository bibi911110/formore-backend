<?php namespace Tests\Repositories;

use App\Models\Extra_services;
use App\Repositories\Extra_servicesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Extra_servicesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Extra_servicesRepository
     */
    protected $extraServicesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->extraServicesRepo = \App::make(Extra_servicesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_extra_services()
    {
        $extraServices = factory(Extra_services::class)->make()->toArray();

        $createdExtra_services = $this->extraServicesRepo->create($extraServices);

        $createdExtra_services = $createdExtra_services->toArray();
        $this->assertArrayHasKey('id', $createdExtra_services);
        $this->assertNotNull($createdExtra_services['id'], 'Created Extra_services must have id specified');
        $this->assertNotNull(Extra_services::find($createdExtra_services['id']), 'Extra_services with given id must be in DB');
        $this->assertModelData($extraServices, $createdExtra_services);
    }

    /**
     * @test read
     */
    public function test_read_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();

        $dbExtra_services = $this->extraServicesRepo->find($extraServices->id);

        $dbExtra_services = $dbExtra_services->toArray();
        $this->assertModelData($extraServices->toArray(), $dbExtra_services);
    }

    /**
     * @test update
     */
    public function test_update_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();
        $fakeExtra_services = factory(Extra_services::class)->make()->toArray();

        $updatedExtra_services = $this->extraServicesRepo->update($fakeExtra_services, $extraServices->id);

        $this->assertModelData($fakeExtra_services, $updatedExtra_services->toArray());
        $dbExtra_services = $this->extraServicesRepo->find($extraServices->id);
        $this->assertModelData($fakeExtra_services, $dbExtra_services->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_extra_services()
    {
        $extraServices = factory(Extra_services::class)->create();

        $resp = $this->extraServicesRepo->delete($extraServices->id);

        $this->assertTrue($resp);
        $this->assertNull(Extra_services::find($extraServices->id), 'Extra_services should not exist in DB');
    }
}
