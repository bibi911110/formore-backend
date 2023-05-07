<?php namespace Tests\Repositories;

use App\Models\Notification_details;
use App\Repositories\Notification_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Notification_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Notification_detailsRepository
     */
    protected $notificationDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->notificationDetailsRepo = \App::make(Notification_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->make()->toArray();

        $createdNotification_details = $this->notificationDetailsRepo->create($notificationDetails);

        $createdNotification_details = $createdNotification_details->toArray();
        $this->assertArrayHasKey('id', $createdNotification_details);
        $this->assertNotNull($createdNotification_details['id'], 'Created Notification_details must have id specified');
        $this->assertNotNull(Notification_details::find($createdNotification_details['id']), 'Notification_details with given id must be in DB');
        $this->assertModelData($notificationDetails, $createdNotification_details);
    }

    /**
     * @test read
     */
    public function test_read_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();

        $dbNotification_details = $this->notificationDetailsRepo->find($notificationDetails->id);

        $dbNotification_details = $dbNotification_details->toArray();
        $this->assertModelData($notificationDetails->toArray(), $dbNotification_details);
    }

    /**
     * @test update
     */
    public function test_update_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();
        $fakeNotification_details = factory(Notification_details::class)->make()->toArray();

        $updatedNotification_details = $this->notificationDetailsRepo->update($fakeNotification_details, $notificationDetails->id);

        $this->assertModelData($fakeNotification_details, $updatedNotification_details->toArray());
        $dbNotification_details = $this->notificationDetailsRepo->find($notificationDetails->id);
        $this->assertModelData($fakeNotification_details, $dbNotification_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();

        $resp = $this->notificationDetailsRepo->delete($notificationDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(Notification_details::find($notificationDetails->id), 'Notification_details should not exist in DB');
    }
}
