<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Web_link_banners;

class Web_link_bannersApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/web_link_banners', $webLinkBanners
        );

        $this->assertApiResponse($webLinkBanners);
    }

    /**
     * @test
     */
    public function test_read_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/web_link_banners/'.$webLinkBanners->id
        );

        $this->assertApiResponse($webLinkBanners->toArray());
    }

    /**
     * @test
     */
    public function test_update_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();
        $editedWeb_link_banners = factory(Web_link_banners::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/web_link_banners/'.$webLinkBanners->id,
            $editedWeb_link_banners
        );

        $this->assertApiResponse($editedWeb_link_banners);
    }

    /**
     * @test
     */
    public function test_delete_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/web_link_banners/'.$webLinkBanners->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/web_link_banners/'.$webLinkBanners->id
        );

        $this->response->assertStatus(404);
    }
}
