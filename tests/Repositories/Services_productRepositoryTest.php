<?php namespace Tests\Repositories;

use App\Models\Services_product;
use App\Repositories\Services_productRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Services_productRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Services_productRepository
     */
    protected $servicesProductRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->servicesProductRepo = \App::make(Services_productRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_services_product()
    {
        $servicesProduct = factory(Services_product::class)->make()->toArray();

        $createdServices_product = $this->servicesProductRepo->create($servicesProduct);

        $createdServices_product = $createdServices_product->toArray();
        $this->assertArrayHasKey('id', $createdServices_product);
        $this->assertNotNull($createdServices_product['id'], 'Created Services_product must have id specified');
        $this->assertNotNull(Services_product::find($createdServices_product['id']), 'Services_product with given id must be in DB');
        $this->assertModelData($servicesProduct, $createdServices_product);
    }

    /**
     * @test read
     */
    public function test_read_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();

        $dbServices_product = $this->servicesProductRepo->find($servicesProduct->id);

        $dbServices_product = $dbServices_product->toArray();
        $this->assertModelData($servicesProduct->toArray(), $dbServices_product);
    }

    /**
     * @test update
     */
    public function test_update_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();
        $fakeServices_product = factory(Services_product::class)->make()->toArray();

        $updatedServices_product = $this->servicesProductRepo->update($fakeServices_product, $servicesProduct->id);

        $this->assertModelData($fakeServices_product, $updatedServices_product->toArray());
        $dbServices_product = $this->servicesProductRepo->find($servicesProduct->id);
        $this->assertModelData($fakeServices_product, $dbServices_product->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_services_product()
    {
        $servicesProduct = factory(Services_product::class)->create();

        $resp = $this->servicesProductRepo->delete($servicesProduct->id);

        $this->assertTrue($resp);
        $this->assertNull(Services_product::find($servicesProduct->id), 'Services_product should not exist in DB');
    }
}
