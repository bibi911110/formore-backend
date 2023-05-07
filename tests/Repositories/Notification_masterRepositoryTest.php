<?php namespace Tests\Repositories;

use App\Models\Notification_master;
use App\Repositories\Notification_masterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Notification_masterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Notification_masterRepository
     */
    protected $notificationMasterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->notificationMasterRepo = \App::make(Notification_masterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->make()->toArray();

        $createdNotification_master = $this->notificationMasterRepo->create($notificationMaster);

        $createdNotification_master = $createdNotification_master->toArray();
        $this->assertArrayHasKey('id', $createdNotification_master);
        $this->assertNotNull($createdNotification_master['id'], 'Created Notification_master must have id specified');
        $this->assertNotNull(Notification_master::find($createdNotification_master['id']), 'Notification_master with given id must be in DB');
        $this->assertModelData($notificationMaster, $createdNotification_master);
    }

    /**
     * @test read
     */
    public function test_read_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();

        $dbNotification_master = $this->notificationMasterRepo->find($notificationMaster->id);

        $dbNotification_master = $dbNotification_master->toArray();
        $this->assertModelData($notificationMaster->toArray(), $dbNotification_master);
    }

    /**
     * @test update
     */
    public function test_update_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();
        $fakeNotification_master = factory(Notification_master::class)->make()->toArray();

        $updatedNotification_master = $this->notificationMasterRepo->update($fakeNotification_master, $notificationMaster->id);

        $this->assertModelData($fakeNotification_master, $updatedNotification_master->toArray());
        $dbNotification_master = $this->notificationMasterRepo->find($notificationMaster->id);
        $this->assertModelData($fakeNotification_master, $dbNotification_master->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();

        $resp = $this->notificationMasterRepo->delete($notificationMaster->id);

        $this->assertTrue($resp);
        $this->assertNull(Notification_master::find($notificationMaster->id), 'Notification_master should not exist in DB');
    }
}
