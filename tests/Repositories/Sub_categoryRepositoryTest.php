<?php namespace Tests\Repositories;

use App\Models\Sub_category;
use App\Repositories\Sub_categoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Sub_categoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Sub_categoryRepository
     */
    protected $subCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->subCategoryRepo = \App::make(Sub_categoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sub_category()
    {
        $subCategory = factory(Sub_category::class)->make()->toArray();

        $createdSub_category = $this->subCategoryRepo->create($subCategory);

        $createdSub_category = $createdSub_category->toArray();
        $this->assertArrayHasKey('id', $createdSub_category);
        $this->assertNotNull($createdSub_category['id'], 'Created Sub_category must have id specified');
        $this->assertNotNull(Sub_category::find($createdSub_category['id']), 'Sub_category with given id must be in DB');
        $this->assertModelData($subCategory, $createdSub_category);
    }

    /**
     * @test read
     */
    public function test_read_sub_category()
    {
        $subCategory = factory(Sub_category::class)->create();

        $dbSub_category = $this->subCategoryRepo->find($subCategory->id);

        $dbSub_category = $dbSub_category->toArray();
        $this->assertModelData($subCategory->toArray(), $dbSub_category);
    }

    /**
     * @test update
     */
    public function test_update_sub_category()
    {
        $subCategory = factory(Sub_category::class)->create();
        $fakeSub_category = factory(Sub_category::class)->make()->toArray();

        $updatedSub_category = $this->subCategoryRepo->update($fakeSub_category, $subCategory->id);

        $this->assertModelData($fakeSub_category, $updatedSub_category->toArray());
        $dbSub_category = $this->subCategoryRepo->find($subCategory->id);
        $this->assertModelData($fakeSub_category, $dbSub_category->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sub_category()
    {
        $subCategory = factory(Sub_category::class)->create();

        $resp = $this->subCategoryRepo->delete($subCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(Sub_category::find($subCategory->id), 'Sub_category should not exist in DB');
    }
}
