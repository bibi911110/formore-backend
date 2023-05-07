<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Notification_details;

class Notification_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/notification_details', $notificationDetails
        );

        $this->assertApiResponse($notificationDetails);
    }

    /**
     * @test
     */
    public function test_read_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/notification_details/'.$notificationDetails->id
        );

        $this->assertApiResponse($notificationDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();
        $editedNotification_details = factory(Notification_details::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/notification_details/'.$notificationDetails->id,
            $editedNotification_details
        );

        $this->assertApiResponse($editedNotification_details);
    }

    /**
     * @test
     */
    public function test_delete_notification_details()
    {
        $notificationDetails = factory(Notification_details::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/notification_details/'.$notificationDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/notification_details/'.$notificationDetails->id
        );

        $this->response->assertStatus(404);
    }
}
