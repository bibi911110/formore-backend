<?php namespace Tests\Repositories;

use App\Models\App_screen_information;
use App\Repositories\App_screen_informationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class App_screen_informationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var App_screen_informationRepository
     */
    protected $appScreenInformationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appScreenInformationRepo = \App::make(App_screen_informationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->make()->toArray();

        $createdApp_screen_information = $this->appScreenInformationRepo->create($appScreenInformation);

        $createdApp_screen_information = $createdApp_screen_information->toArray();
        $this->assertArrayHasKey('id', $createdApp_screen_information);
        $this->assertNotNull($createdApp_screen_information['id'], 'Created App_screen_information must have id specified');
        $this->assertNotNull(App_screen_information::find($createdApp_screen_information['id']), 'App_screen_information with given id must be in DB');
        $this->assertModelData($appScreenInformation, $createdApp_screen_information);
    }

    /**
     * @test read
     */
    public function test_read_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();

        $dbApp_screen_information = $this->appScreenInformationRepo->find($appScreenInformation->id);

        $dbApp_screen_information = $dbApp_screen_information->toArray();
        $this->assertModelData($appScreenInformation->toArray(), $dbApp_screen_information);
    }

    /**
     * @test update
     */
    public function test_update_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();
        $fakeApp_screen_information = factory(App_screen_information::class)->make()->toArray();

        $updatedApp_screen_information = $this->appScreenInformationRepo->update($fakeApp_screen_information, $appScreenInformation->id);

        $this->assertModelData($fakeApp_screen_information, $updatedApp_screen_information->toArray());
        $dbApp_screen_information = $this->appScreenInformationRepo->find($appScreenInformation->id);
        $this->assertModelData($fakeApp_screen_information, $dbApp_screen_information->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_screen_information()
    {
        $appScreenInformation = factory(App_screen_information::class)->create();

        $resp = $this->appScreenInformationRepo->delete($appScreenInformation->id);

        $this->assertTrue($resp);
        $this->assertNull(App_screen_information::find($appScreenInformation->id), 'App_screen_information should not exist in DB');
    }
}
