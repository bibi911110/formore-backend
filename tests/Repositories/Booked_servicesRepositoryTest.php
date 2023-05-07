<?php namespace Tests\Repositories;

use App\Models\Booked_services;
use App\Repositories\Booked_servicesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Booked_servicesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Booked_servicesRepository
     */
    protected $bookedServicesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bookedServicesRepo = \App::make(Booked_servicesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->make()->toArray();

        $createdBooked_services = $this->bookedServicesRepo->create($bookedServices);

        $createdBooked_services = $createdBooked_services->toArray();
        $this->assertArrayHasKey('id', $createdBooked_services);
        $this->assertNotNull($createdBooked_services['id'], 'Created Booked_services must have id specified');
        $this->assertNotNull(Booked_services::find($createdBooked_services['id']), 'Booked_services with given id must be in DB');
        $this->assertModelData($bookedServices, $createdBooked_services);
    }

    /**
     * @test read
     */
    public function test_read_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();

        $dbBooked_services = $this->bookedServicesRepo->find($bookedServices->id);

        $dbBooked_services = $dbBooked_services->toArray();
        $this->assertModelData($bookedServices->toArray(), $dbBooked_services);
    }

    /**
     * @test update
     */
    public function test_update_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();
        $fakeBooked_services = factory(Booked_services::class)->make()->toArray();

        $updatedBooked_services = $this->bookedServicesRepo->update($fakeBooked_services, $bookedServices->id);

        $this->assertModelData($fakeBooked_services, $updatedBooked_services->toArray());
        $dbBooked_services = $this->bookedServicesRepo->find($bookedServices->id);
        $this->assertModelData($fakeBooked_services, $dbBooked_services->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_booked_services()
    {
        $bookedServices = factory(Booked_services::class)->create();

        $resp = $this->bookedServicesRepo->delete($bookedServices->id);

        $this->assertTrue($resp);
        $this->assertNull(Booked_services::find($bookedServices->id), 'Booked_services should not exist in DB');
    }
}
