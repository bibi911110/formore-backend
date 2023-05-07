<?php namespace Tests\Repositories;

use App\Models\Social_icon;
use App\Repositories\Social_iconRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Social_iconRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Social_iconRepository
     */
    protected $socialIconRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->socialIconRepo = \App::make(Social_iconRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->make()->toArray();

        $createdSocial_icon = $this->socialIconRepo->create($socialIcon);

        $createdSocial_icon = $createdSocial_icon->toArray();
        $this->assertArrayHasKey('id', $createdSocial_icon);
        $this->assertNotNull($createdSocial_icon['id'], 'Created Social_icon must have id specified');
        $this->assertNotNull(Social_icon::find($createdSocial_icon['id']), 'Social_icon with given id must be in DB');
        $this->assertModelData($socialIcon, $createdSocial_icon);
    }

    /**
     * @test read
     */
    public function test_read_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();

        $dbSocial_icon = $this->socialIconRepo->find($socialIcon->id);

        $dbSocial_icon = $dbSocial_icon->toArray();
        $this->assertModelData($socialIcon->toArray(), $dbSocial_icon);
    }

    /**
     * @test update
     */
    public function test_update_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();
        $fakeSocial_icon = factory(Social_icon::class)->make()->toArray();

        $updatedSocial_icon = $this->socialIconRepo->update($fakeSocial_icon, $socialIcon->id);

        $this->assertModelData($fakeSocial_icon, $updatedSocial_icon->toArray());
        $dbSocial_icon = $this->socialIconRepo->find($socialIcon->id);
        $this->assertModelData($fakeSocial_icon, $dbSocial_icon->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_social_icon()
    {
        $socialIcon = factory(Social_icon::class)->create();

        $resp = $this->socialIconRepo->delete($socialIcon->id);

        $this->assertTrue($resp);
        $this->assertNull(Social_icon::find($socialIcon->id), 'Social_icon should not exist in DB');
    }
}
