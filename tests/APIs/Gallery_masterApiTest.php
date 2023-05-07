<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Gallery_master;

class Gallery_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/gallery_masters', $galleryMaster
        );

        $this->assertApiResponse($galleryMaster);
    }

    /**
     * @test
     */
    public function test_read_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/gallery_masters/'.$galleryMaster->id
        );

        $this->assertApiResponse($galleryMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();
        $editedGallery_master = factory(Gallery_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/gallery_masters/'.$galleryMaster->id,
            $editedGallery_master
        );

        $this->assertApiResponse($editedGallery_master);
    }

    /**
     * @test
     */
    public function test_delete_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/gallery_masters/'.$galleryMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/gallery_masters/'.$galleryMaster->id
        );

        $this->response->assertStatus(404);
    }
}
