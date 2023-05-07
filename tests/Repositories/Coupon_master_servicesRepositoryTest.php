<?php namespace Tests\Repositories;

use App\Models\Coupon_master_services;
use App\Repositories\Coupon_master_servicesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Coupon_master_servicesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Coupon_master_servicesRepository
     */
    protected $couponMasterServicesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->couponMasterServicesRepo = \App::make(Coupon_master_servicesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->make()->toArray();

        $createdCoupon_master_services = $this->couponMasterServicesRepo->create($couponMasterServices);

        $createdCoupon_master_services = $createdCoupon_master_services->toArray();
        $this->assertArrayHasKey('id', $createdCoupon_master_services);
        $this->assertNotNull($createdCoupon_master_services['id'], 'Created Coupon_master_services must have id specified');
        $this->assertNotNull(Coupon_master_services::find($createdCoupon_master_services['id']), 'Coupon_master_services with given id must be in DB');
        $this->assertModelData($couponMasterServices, $createdCoupon_master_services);
    }

    /**
     * @test read
     */
    public function test_read_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();

        $dbCoupon_master_services = $this->couponMasterServicesRepo->find($couponMasterServices->id);

        $dbCoupon_master_services = $dbCoupon_master_services->toArray();
        $this->assertModelData($couponMasterServices->toArray(), $dbCoupon_master_services);
    }

    /**
     * @test update
     */
    public function test_update_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();
        $fakeCoupon_master_services = factory(Coupon_master_services::class)->make()->toArray();

        $updatedCoupon_master_services = $this->couponMasterServicesRepo->update($fakeCoupon_master_services, $couponMasterServices->id);

        $this->assertModelData($fakeCoupon_master_services, $updatedCoupon_master_services->toArray());
        $dbCoupon_master_services = $this->couponMasterServicesRepo->find($couponMasterServices->id);
        $this->assertModelData($fakeCoupon_master_services, $dbCoupon_master_services->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_coupon_master_services()
    {
        $couponMasterServices = factory(Coupon_master_services::class)->create();

        $resp = $this->couponMasterServicesRepo->delete($couponMasterServices->id);

        $this->assertTrue($resp);
        $this->assertNull(Coupon_master_services::find($couponMasterServices->id), 'Coupon_master_services should not exist in DB');
    }
}
