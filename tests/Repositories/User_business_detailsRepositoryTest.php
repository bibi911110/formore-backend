<?php namespace Tests\Repositories;

use App\Models\User_business_details;
use App\Repositories\User_business_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class User_business_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var User_business_detailsRepository
     */
    protected $userBusinessDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userBusinessDetailsRepo = \App::make(User_business_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->make()->toArray();

        $createdUser_business_details = $this->userBusinessDetailsRepo->create($userBusinessDetails);

        $createdUser_business_details = $createdUser_business_details->toArray();
        $this->assertArrayHasKey('id', $createdUser_business_details);
        $this->assertNotNull($createdUser_business_details['id'], 'Created User_business_details must have id specified');
        $this->assertNotNull(User_business_details::find($createdUser_business_details['id']), 'User_business_details with given id must be in DB');
        $this->assertModelData($userBusinessDetails, $createdUser_business_details);
    }

    /**
     * @test read
     */
    public function test_read_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();

        $dbUser_business_details = $this->userBusinessDetailsRepo->find($userBusinessDetails->id);

        $dbUser_business_details = $dbUser_business_details->toArray();
        $this->assertModelData($userBusinessDetails->toArray(), $dbUser_business_details);
    }

    /**
     * @test update
     */
    public function test_update_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();
        $fakeUser_business_details = factory(User_business_details::class)->make()->toArray();

        $updatedUser_business_details = $this->userBusinessDetailsRepo->update($fakeUser_business_details, $userBusinessDetails->id);

        $this->assertModelData($fakeUser_business_details, $updatedUser_business_details->toArray());
        $dbUser_business_details = $this->userBusinessDetailsRepo->find($userBusinessDetails->id);
        $this->assertModelData($fakeUser_business_details, $dbUser_business_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_business_details()
    {
        $userBusinessDetails = factory(User_business_details::class)->create();

        $resp = $this->userBusinessDetailsRepo->delete($userBusinessDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(User_business_details::find($userBusinessDetails->id), 'User_business_details should not exist in DB');
    }
}
