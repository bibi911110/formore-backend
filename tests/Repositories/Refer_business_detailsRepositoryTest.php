<?php namespace Tests\Repositories;

use App\Models\Refer_business_details;
use App\Repositories\Refer_business_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Refer_business_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Refer_business_detailsRepository
     */
    protected $referBusinessDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->referBusinessDetailsRepo = \App::make(Refer_business_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->make()->toArray();

        $createdRefer_business_details = $this->referBusinessDetailsRepo->create($referBusinessDetails);

        $createdRefer_business_details = $createdRefer_business_details->toArray();
        $this->assertArrayHasKey('id', $createdRefer_business_details);
        $this->assertNotNull($createdRefer_business_details['id'], 'Created Refer_business_details must have id specified');
        $this->assertNotNull(Refer_business_details::find($createdRefer_business_details['id']), 'Refer_business_details with given id must be in DB');
        $this->assertModelData($referBusinessDetails, $createdRefer_business_details);
    }

    /**
     * @test read
     */
    public function test_read_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();

        $dbRefer_business_details = $this->referBusinessDetailsRepo->find($referBusinessDetails->id);

        $dbRefer_business_details = $dbRefer_business_details->toArray();
        $this->assertModelData($referBusinessDetails->toArray(), $dbRefer_business_details);
    }

    /**
     * @test update
     */
    public function test_update_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();
        $fakeRefer_business_details = factory(Refer_business_details::class)->make()->toArray();

        $updatedRefer_business_details = $this->referBusinessDetailsRepo->update($fakeRefer_business_details, $referBusinessDetails->id);

        $this->assertModelData($fakeRefer_business_details, $updatedRefer_business_details->toArray());
        $dbRefer_business_details = $this->referBusinessDetailsRepo->find($referBusinessDetails->id);
        $this->assertModelData($fakeRefer_business_details, $dbRefer_business_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_refer_business_details()
    {
        $referBusinessDetails = factory(Refer_business_details::class)->create();

        $resp = $this->referBusinessDetailsRepo->delete($referBusinessDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(Refer_business_details::find($referBusinessDetails->id), 'Refer_business_details should not exist in DB');
    }
}
