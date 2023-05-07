<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Purchase_options;

class Purchase_optionsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/purchase_options', $purchaseOptions
        );

        $this->assertApiResponse($purchaseOptions);
    }

    /**
     * @test
     */
    public function test_read_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/purchase_options/'.$purchaseOptions->id
        );

        $this->assertApiResponse($purchaseOptions->toArray());
    }

    /**
     * @test
     */
    public function test_update_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();
        $editedPurchase_options = factory(Purchase_options::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/purchase_options/'.$purchaseOptions->id,
            $editedPurchase_options
        );

        $this->assertApiResponse($editedPurchase_options);
    }

    /**
     * @test
     */
    public function test_delete_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/purchase_options/'.$purchaseOptions->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/purchase_options/'.$purchaseOptions->id
        );

        $this->response->assertStatus(404);
    }
}
