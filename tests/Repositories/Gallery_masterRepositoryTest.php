<?php namespace Tests\Repositories;

use App\Models\Gallery_master;
use App\Repositories\Gallery_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Gallery_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Gallery_masterRepository
     */
    protected $galleryMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->galleryMasterRepo = \App::make(Gallery_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->make()->toArray();

        $createdGallery_master = $this->galleryMasterRepo->create($galleryMaster);

        $createdGallery_master = $createdGallery_master->toArray();
        $this->assertArrayHasKey('id', $createdGallery_master);
        $this->assertNotNull($createdGallery_master['id'], 'Created Gallery_master must have id specified');
        $this->assertNotNull(Gallery_master::find($createdGallery_master['id']), 'Gallery_master with given id must be in DB');
        $this->assertModelData($galleryMaster, $createdGallery_master);
    }

    /**
     * @test read
     */
    public function test_read_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();

        $dbGallery_master = $this->galleryMasterRepo->find($galleryMaster->id);

        $dbGallery_master = $dbGallery_master->toArray();
        $this->assertModelData($galleryMaster->toArray(), $dbGallery_master);
    }

    /**
     * @test update
     */
    public function test_update_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();
        $fakeGallery_master = factory(Gallery_master::class)->make()->toArray();

        $updatedGallery_master = $this->galleryMasterRepo->update($fakeGallery_master, $galleryMaster->id);

        $this->assertModelData($fakeGallery_master, $updatedGallery_master->toArray());
        $dbGallery_master = $this->galleryMasterRepo->find($galleryMaster->id);
        $this->assertModelData($fakeGallery_master, $dbGallery_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_gallery_master()
    {
        $galleryMaster = factory(Gallery_master::class)->create();

        $resp = $this->galleryMasterRepo->delete($galleryMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Gallery_master::find($galleryMaster->id), 'Gallery_master should not exist in DB');
    }
}
