<?php namespace Tests\Repositories;

use App\Models\Web_link_banners;
use App\Repositories\Web_link_bannersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Web_link_bannersRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Web_link_bannersRepository
     */
    protected $webLinkBannersRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->webLinkBannersRepo = \App::make(Web_link_bannersRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->make()->toArray();

        $createdWeb_link_banners = $this->webLinkBannersRepo->create($webLinkBanners);

        $createdWeb_link_banners = $createdWeb_link_banners->toArray();
        $this->assertArrayHasKey('id', $createdWeb_link_banners);
        $this->assertNotNull($createdWeb_link_banners['id'], 'Created Web_link_banners must have id specified');
        $this->assertNotNull(Web_link_banners::find($createdWeb_link_banners['id']), 'Web_link_banners with given id must be in DB');
        $this->assertModelData($webLinkBanners, $createdWeb_link_banners);
    }

    /**
     * @test read
     */
    public function test_read_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();

        $dbWeb_link_banners = $this->webLinkBannersRepo->find($webLinkBanners->id);

        $dbWeb_link_banners = $dbWeb_link_banners->toArray();
        $this->assertModelData($webLinkBanners->toArray(), $dbWeb_link_banners);
    }

    /**
     * @test update
     */
    public function test_update_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();
        $fakeWeb_link_banners = factory(Web_link_banners::class)->make()->toArray();

        $updatedWeb_link_banners = $this->webLinkBannersRepo->update($fakeWeb_link_banners, $webLinkBanners->id);

        $this->assertModelData($fakeWeb_link_banners, $updatedWeb_link_banners->toArray());
        $dbWeb_link_banners = $this->webLinkBannersRepo->find($webLinkBanners->id);
        $this->assertModelData($fakeWeb_link_banners, $dbWeb_link_banners->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_web_link_banners()
    {
        $webLinkBanners = factory(Web_link_banners::class)->create();

        $resp = $this->webLinkBannersRepo->delete($webLinkBanners->id);

        $this->assertTrue($resp);
        $this->assertNull(Web_link_banners::find($webLinkBanners->id), 'Web_link_banners should not exist in DB');
    }
}
