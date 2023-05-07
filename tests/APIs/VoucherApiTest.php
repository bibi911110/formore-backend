<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Voucher;

class VoucherApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_voucher()
    {
        $voucher = factory(Voucher::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/vouchers', $voucher
        );

        $this->assertApiResponse($voucher);
    }

    /**
     * @test
     */
    public function test_read_voucher()
    {
        $voucher = factory(Voucher::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/vouchers/'.$voucher->id
        );

        $this->assertApiResponse($voucher->toArray());
    }

    /**
     * @test
     */
    public function test_update_voucher()
    {
        $voucher = factory(Voucher::class)->create();
        $editedVoucher = factory(Voucher::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/vouchers/'.$voucher->id,
            $editedVoucher
        );

        $this->assertApiResponse($editedVoucher);
    }

    /**
     * @test
     */
    public function test_delete_voucher()
    {
        $voucher = factory(Voucher::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/vouchers/'.$voucher->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/vouchers/'.$voucher->id
        );

        $this->response->assertStatus(404);
    }
}
