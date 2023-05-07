<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\User_voucher;

class User_voucherApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_vouchers', $userVoucher
        );

        $this->assertApiResponse($userVoucher);
    }

    /**
     * @test
     */
    public function test_read_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_vouchers/'.$userVoucher->id
        );

        $this->assertApiResponse($userVoucher->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();
        $editedUser_voucher = factory(User_voucher::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_vouchers/'.$userVoucher->id,
            $editedUser_voucher
        );

        $this->assertApiResponse($editedUser_voucher);
    }

    /**
     * @test
     */
    public function test_delete_user_voucher()
    {
        $userVoucher = factory(User_voucher::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_vouchers/'.$userVoucher->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_vouchers/'.$userVoucher->id
        );

        $this->response->assertStatus(404);
    }
}
