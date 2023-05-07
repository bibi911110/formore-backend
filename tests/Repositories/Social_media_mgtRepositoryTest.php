<?php namespace Tests\Repositories;

use App\Models\Social_media_mgt;
use App\Repositories\Social_media_mgtRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Social_media_mgtRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Social_media_mgtRepository
     */
    protected $socialMediaMgtRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->socialMediaMgtRepo = \App::make(Social_media_mgtRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->make()->toArray();

        $createdSocial_media_mgt = $this->socialMediaMgtRepo->create($socialMediaMgt);

        $createdSocial_media_mgt = $createdSocial_media_mgt->toArray();
        $this->assertArrayHasKey('id', $createdSocial_media_mgt);
        $this->assertNotNull($createdSocial_media_mgt['id'], 'Created Social_media_mgt must have id specified');
        $this->assertNotNull(Social_media_mgt::find($createdSocial_media_mgt['id']), 'Social_media_mgt with given id must be in DB');
        $this->assertModelData($socialMediaMgt, $createdSocial_media_mgt);
    }

    /**
     * @test read
     */
    public function test_read_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();

        $dbSocial_media_mgt = $this->socialMediaMgtRepo->find($socialMediaMgt->id);

        $dbSocial_media_mgt = $dbSocial_media_mgt->toArray();
        $this->assertModelData($socialMediaMgt->toArray(), $dbSocial_media_mgt);
    }

    /**
     * @test update
     */
    public function test_update_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();
        $fakeSocial_media_mgt = factory(Social_media_mgt::class)->make()->toArray();

        $updatedSocial_media_mgt = $this->socialMediaMgtRepo->update($fakeSocial_media_mgt, $socialMediaMgt->id);

        $this->assertModelData($fakeSocial_media_mgt, $updatedSocial_media_mgt->toArray());
        $dbSocial_media_mgt = $this->socialMediaMgtRepo->find($socialMediaMgt->id);
        $this->assertModelData($fakeSocial_media_mgt, $dbSocial_media_mgt->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_social_media_mgt()
    {
        $socialMediaMgt = factory(Social_media_mgt::class)->create();

        $resp = $this->socialMediaMgtRepo->delete($socialMediaMgt->id);

        $this->assertTrue($resp);
        $this->assertNull(Social_media_mgt::find($socialMediaMgt->id), 'Social_media_mgt should not exist in DB');
    }
}
