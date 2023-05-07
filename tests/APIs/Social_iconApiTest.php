<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Social_icon;

class Social_iconApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/social_icons', $socialIcon
        );

        $this->assertApiResponse($socialIcon);
    }

    /**
     * @test
     */
    public function test_read_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/social_icons/'.$socialIcon->id
        );

        $this->assertApiResponse($socialIcon->toArray());
    }

    /**
     * @test
     */
    public function test_update_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();
        $editedSocial_icon = factory(Social_icon::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/social_icons/'.$socialIcon->id,
            $editedSocial_icon
        );

        $this->assertApiResponse($editedSocial_icon);
    }

    /**
     * @test
     */
    public function test_delete_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/social_icons/'.$socialIcon->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/social_icons/'.$socialIcon->id
        );

        $this->response->assertStatus(404);
    }
}
