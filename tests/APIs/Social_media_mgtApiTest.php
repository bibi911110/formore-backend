<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Social_media_mgt;

class Social_media_mgtApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/social_media_mgts', $socialMediaMgt
        );

        $this->assertApiResponse($socialMediaMgt);
    }

    /**
     * @test
     */
    public function test_read_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/social_media_mgts/'.$socialMediaMgt->id
        );

        $this->assertApiResponse($socialMediaMgt->toArray());
    }

    /**
     * @test
     */
    public function test_update_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();
        $editedSocial_media_mgt = factory(Social_media_mgt::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/social_media_mgts/'.$socialMediaMgt->id,
            $editedSocial_media_mgt
        );

        $this->assertApiResponse($editedSocial_media_mgt);
    }

    /**
     * @test
     */
    public function test_delete_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/social_media_mgts/'.$socialMediaMgt->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/social_media_mgts/'.$socialMediaMgt->id
        );

        $this->response->assertStatus(404);
    }
}
