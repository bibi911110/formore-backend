<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Notification_master;

class Notification_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/notification_masters', $notificationMaster
        );

        $this->assertApiResponse($notificationMaster);
    }

    /**
     * @test
     */
    public function test_read_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/notification_masters/'.$notificationMaster->id
        );

        $this->assertApiResponse($notificationMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();
        $editedNotification_master = factory(Notification_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/notification_masters/'.$notificationMaster->id,
            $editedNotification_master
        );

        $this->assertApiResponse($editedNotification_master);
    }

    /**
     * @test
     */
    public function test_delete_notification_master()
    {
        $notificationMaster = factory(Notification_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/notification_masters/'.$notificationMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/notification_masters/'.$notificationMaster->id
        );

        $this->response->assertStatus(404);
    }
}
