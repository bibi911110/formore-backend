<?php namespace Tests\Repositories;

use App\Models\User_voucher;
use App\Repositories\User_voucherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class User_voucherRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var User_voucherRepository
     */
    protected $userVoucherRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userVoucherRepo = \App::make(User_voucherRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->make()->toArray();

        $createdUser_voucher = $this->userVoucherRepo->create($userVoucher);

        $createdUser_voucher = $createdUser_voucher->toArray();
        $this->assertArrayHasKey('id', $createdUser_voucher);
        $this->assertNotNull($createdUser_voucher['id'], 'Created User_voucher must have id specified');
        $this->assertNotNull(User_voucher::find($createdUser_voucher['id']), 'User_voucher with given id must be in DB');
        $this->assertModelData($userVoucher, $createdUser_voucher);
    }

    /**
     * @test read
     */
    public function test_read_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();

        $dbUser_voucher = $this->userVoucherRepo->find($userVoucher->id);

        $dbUser_voucher = $dbUser_voucher->toArray();
        $this->assertModelData($userVoucher->toArray(), $dbUser_voucher);
    }

    /**
     * @test update
     */
    public function test_update_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();
        $fakeUser_voucher = factory(User_voucher::class)->make()->toArray();

        $updatedUser_voucher = $this->userVoucherRepo->update($fakeUser_voucher, $userVoucher->id);

        $this->assertModelData($fakeUser_voucher, $updatedUser_voucher->toArray());
        $dbUser_voucher = $this->userVoucherRepo->find($userVoucher->id);
        $this->assertModelData($fakeUser_voucher, $dbUser_voucher->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();

        $resp = $this->userVoucherRepo->delete($userVoucher->id);

        $this->assertTrue($resp);
        $this->assertNull(User_voucher::find($userVoucher->id), 'User_voucher should not exist in DB');
    }
}
