<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Gift_vocher_types;

class Gift_vocher_typesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/gift_vocher_types', $giftVocherTypes
        );

        $this->assertApiResponse($giftVocherTypes);
    }

    /**
     * @test
     */
    public function test_read_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/gift_vocher_types/'.$giftVocherTypes->id
        );

        $this->assertApiResponse($giftVocherTypes->toArray());
    }

    /**
     * @test
     */
    public function test_update_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();
        $editedGift_vocher_types = factory(Gift_vocher_types::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/gift_vocher_types/'.$giftVocherTypes->id,
            $editedGift_vocher_types
        );

        $this->assertApiResponse($editedGift_vocher_types);
    }

    /**
     * @test
     */
    public function test_delete_gift_vocher_types()
    {
        $giftVocherTypes = factory(Gift_vocher_types::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/gift_vocher_types/'.$giftVocherTypes->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/gift_vocher_types/'.$giftVocherTypes->id
        );

        $this->response->assertStatus(404);
    }
}
