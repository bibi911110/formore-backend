<?php namespace Tests\Repositories;

use App\Models\Gift_vocher_types;
use App\Repositories\Gift_vocher_typesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Gift_vocher_typesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Gift_vocher_typesRepository
     */
    protected $giftVocherTypesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->giftVocherTypesRepo = \App::make(Gift_vocher_typesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->make()->toArray();

        $createdGift_vocher_types = $this->giftVocherTypesRepo->create($giftVocherTypes);

        $createdGift_vocher_types = $createdGift_vocher_types->toArray();
        $this->assertArrayHasKey('id', $createdGift_vocher_types);
        $this->assertNotNull($createdGift_vocher_types['id'], 'Created Gift_vocher_types must have id specified');
        $this->assertNotNull(Gift_vocher_types::find($createdGift_vocher_types['id']), 'Gift_vocher_types with given id must be in DB');
        $this->assertModelData($giftVocherTypes, $createdGift_vocher_types);
    }

    /**
     * @test read
     */
    public function test_read_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();

        $dbGift_vocher_types = $this->giftVocherTypesRepo->find($giftVocherTypes->id);

        $dbGift_vocher_types = $dbGift_vocher_types->toArray();
        $this->assertModelData($giftVocherTypes->toArray(), $dbGift_vocher_types);
    }

    /**
     * @test update
     */
    public function test_update_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();
        $fakeGift_vocher_types = factory(Gift_vocher_types::class)->make()->toArray();

        $updatedGift_vocher_types = $this->giftVocherTypesRepo->update($fakeGift_vocher_types, $giftVocherTypes->id);

        $this->assertModelData($fakeGift_vocher_types, $updatedGift_vocher_types->toArray());
        $dbGift_vocher_types = $this->giftVocherTypesRepo->find($giftVocherTypes->id);
        $this->assertModelData($fakeGift_vocher_types, $dbGift_vocher_types->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();

        $resp = $this->giftVocherTypesRepo->delete($giftVocherTypes->id);

        $this->assertTrue($resp);
        $this->assertNull(Gift_vocher_types::find($giftVocherTypes->id), 'Gift_vocher_types should not exist in DB');
    }
}
