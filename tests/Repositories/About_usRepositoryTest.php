<?php namespace Tests\Repositories;

use App\Models\About_us;
use App\Repositories\About_usRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class About_usRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var About_usRepository
     */
    protected $aboutUsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->aboutUsRepo = \App::make(About_usRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_about_us()
    {
        $aboutUs = factory(About_us::class)->make()->toArray();

        $createdAbout_us = $this->aboutUsRepo->create($aboutUs);

        $createdAbout_us = $createdAbout_us->toArray();
        $this->assertArrayHasKey('id', $createdAbout_us);
        $this->assertNotNull($createdAbout_us['id'], 'Created About_us must have id specified');
        $this->assertNotNull(About_us::find($createdAbout_us['id']), 'About_us with given id must be in DB');
        $this->assertModelData($aboutUs, $createdAbout_us);
    }

    /**
     * @test read
     */
    public function test_read_about_us()
    {
        $aboutUs = factory(About_us::class)->create();

        $dbAbout_us = $this->aboutUsRepo->find($aboutUs->id);

        $dbAbout_us = $dbAbout_us->toArray();
        $this->assertModelData($aboutUs->toArray(), $dbAbout_us);
    }

    /**
     * @test update
     */
    public function test_update_about_us()
    {
        $aboutUs = factory(About_us::class)->create();
        $fakeAbout_us = factory(About_us::class)->make()->toArray();

        $updatedAbout_us = $this->aboutUsRepo->update($fakeAbout_us, $aboutUs->id);

        $this->assertModelData($fakeAbout_us, $updatedAbout_us->toArray());
        $dbAbout_us = $this->aboutUsRepo->find($aboutUs->id);
        $this->assertModelData($fakeAbout_us, $dbAbout_us->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_about_us()
    {
        $aboutUs = factory(About_us::class)->create();

        $resp = $this->aboutUsRepo->delete($aboutUs->id);

        $this->assertTrue($resp);
        $this->assertNull(About_us::find($aboutUs->id), 'About_us should not exist in DB');
    }
}
