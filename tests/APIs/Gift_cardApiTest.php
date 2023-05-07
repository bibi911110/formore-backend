<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Gift_card;

class Gift_cardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_gift_card()
    {
        $giftCard = factory(Gift_card::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/gift_cards', $giftCard
        );

        $this->assertApiResponse($giftCard);
    }

    /**
     * @test
     */
    public function test_read_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/gift_cards/'.$giftCard->id
        );

        $this->assertApiResponse($giftCard->toArray());
    }

    /**
     * @test
     */
    public function test_update_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();
        $editedGift_card = factory(Gift_card::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/gift_cards/'.$giftCard->id,
            $editedGift_card
        );

        $this->assertApiResponse($editedGift_card);
    }

    /**
     * @test
     */
    public function test_delete_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/gift_cards/'.$giftCard->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/gift_cards/'.$giftCard->id
        );

        $this->response->assertStatus(404);
    }
}
