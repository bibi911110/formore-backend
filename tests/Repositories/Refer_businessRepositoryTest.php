<?php namespace Tests\Repositories;

use App\Models\Refer_business;
use App\Repositories\Refer_businessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Refer_businessRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Refer_businessRepository
     */
    protected $referBusinessRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->referBusinessRepo = \App::make(Refer_businessRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->make()->toArray();

        $createdRefer_business = $this->referBusinessRepo->create($referBusiness);

        $createdRefer_business = $createdRefer_business->toArray();
        $this->assertArrayHasKey('id', $createdRefer_business);
        $this->assertNotNull($createdRefer_business['id'], 'Created Refer_business must have id specified');
        $this->assertNotNull(Refer_business::find($createdRefer_business['id']), 'Refer_business with given id must be in DB');
        $this->assertModelData($referBusiness, $createdRefer_business);
    }

    /**
     * @test read
     */
    public function test_read_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();

        $dbRefer_business = $this->referBusinessRepo->find($referBusiness->id);

        $dbRefer_business = $dbRefer_business->toArray();
        $this->assertModelData($referBusiness->toArray(), $dbRefer_business);
    }

    /**
     * @test update
     */
    public function test_update_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();
        $fakeRefer_business = factory(Refer_business::class)->make()->toArray();

        $updatedRefer_business = $this->referBusinessRepo->update($fakeRefer_business, $referBusiness->id);

        $this->assertModelData($fakeRefer_business, $updatedRefer_business->toArray());
        $dbRefer_business = $this->referBusinessRepo->find($referBusiness->id);
        $this->assertModelData($fakeRefer_business, $dbRefer_business->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_refer_business()
    {
        $referBusiness = factory(Refer_business::class)->create();

        $resp = $this->referBusinessRepo->delete($referBusiness->id);

        $this->assertTrue($resp);
        $this->assertNull(Refer_business::find($referBusiness->id), 'Refer_business should not exist in DB');
    }
}
