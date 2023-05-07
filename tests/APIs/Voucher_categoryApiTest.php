<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Voucher_category;

class Voucher_categoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/voucher_categories', $voucherCategory
        );

        $this->assertApiResponse($voucherCategory);
    }

    /**
     * @test
     */
    public function test_read_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/voucher_categories/'.$voucherCategory->id
        );

        $this->assertApiResponse($voucherCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();
        $editedVoucher_category = factory(Voucher_category::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/voucher_categories/'.$voucherCategory->id,
            $editedVoucher_category
        );

        $this->assertApiResponse($editedVoucher_category);
    }

    /**
     * @test
     */
    public function test_delete_voucher_category()
    {
        $voucherCategory = factory(Voucher_category::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/voucher_categories/'.$voucherCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/voucher_categories/'.$voucherCategory->id
        );

        $this->response->assertStatus(404);
    }
}
