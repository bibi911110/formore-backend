<?php namespace Tests\Repositories;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BrandRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BrandRepository
     */
    protected $brandRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->brandRepo = \App::make(BrandRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_brand()
    {
        $brand = factory(Brand::class)->make()->toArray();

        $createdBrand = $this->brandRepo->create($brand);

        $createdBrand = $createdBrand->toArray();
        $this->assertArrayHasKey('id', $createdBrand);
        $this->assertNotNull($createdBrand['id'], 'Created Brand must have id specified');
        $this->assertNotNull(Brand::find($createdBrand['id']), 'Brand with given id must be in DB');
        $this->assertModelData($brand, $createdBrand);
    }

    /**
     * @test read
     */
    public function test_read_brand()
    {
        $brand = factory(Brand::class)->create();

        $dbBrand = $this->brandRepo->find($brand->id);

        $dbBrand = $dbBrand->toArray();
        $this->assertModelData($brand->toArray(), $dbBrand);
    }

    /**
     * @test update
     */
    public function test_update_brand()
    {
        $brand = factory(Brand::class)->create();
        $fakeBrand = factory(Brand::class)->make()->toArray();

        $updatedBrand = $this->brandRepo->update($fakeBrand, $brand->id);

        $this->assertModelData($fakeBrand, $updatedBrand->toArray());
        $dbBrand = $this->brandRepo->find($brand->id);
        $this->assertModelData($fakeBrand, $dbBrand->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_brand()
    {
        $brand = factory(Brand::class)->create();

        $resp = $this->brandRepo->delete($brand->id);

        $this->assertTrue($resp);
        $this->assertNull(Brand::find($brand->id), 'Brand should not exist in DB');
    }
}
