<?php namespace Tests\Repositories;

use App\Models\Gift_card;
use App\Repositories\Gift_cardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Gift_cardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Gift_cardRepository
     */
    protected $giftCardRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->giftCardRepo = \App::make(Gift_cardRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_gift_card()
    {
        $giftCard = factory(Gift_card::class)->make()->toArray();

        $createdGift_card = $this->giftCardRepo->create($giftCard);

        $createdGift_card = $createdGift_card->toArray();
        $this->assertArrayHasKey('id', $createdGift_card);
        $this->assertNotNull($createdGift_card['id'], 'Created Gift_card must have id specified');
        $this->assertNotNull(Gift_card::find($createdGift_card['id']), 'Gift_card with given id must be in DB');
        $this->assertModelData($giftCard, $createdGift_card);
    }

    /**
     * @test read
     */
    public function test_read_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();

        $dbGift_card = $this->giftCardRepo->find($giftCard->id);

        $dbGift_card = $dbGift_card->toArray();
        $this->assertModelData($giftCard->toArray(), $dbGift_card);
    }

    /**
     * @test update
     */
    public function test_update_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();
        $fakeGift_card = factory(Gift_card::class)->make()->toArray();

        $updatedGift_card = $this->giftCardRepo->update($fakeGift_card, $giftCard->id);

        $this->assertModelData($fakeGift_card, $updatedGift_card->toArray());
        $dbGift_card = $this->giftCardRepo->find($giftCard->id);
        $this->assertModelData($fakeGift_card, $dbGift_card->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_gift_card()
    {
        $giftCard = factory(Gift_card::class)->create();

        $resp = $this->giftCardRepo->delete($giftCard->id);

        $this->assertTrue($resp);
        $this->assertNull(Gift_card::find($giftCard->id), 'Gift_card should not exist in DB');
    }
}
