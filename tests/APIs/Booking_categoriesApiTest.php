<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Booking_categories;

class Booking_categoriesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/booking_categories', $bookingCategories
        );

        $this->assertApiResponse($bookingCategories);
    }

    /**
     * @test
     */
    public function test_read_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/booking_categories/'.$bookingCategories->id
        );

        $this->assertApiResponse($bookingCategories->toArray());
    }

    /**
     * @test
     */
    public function test_update_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();
        $editedBooking_categories = factory(Booking_categories::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/booking_categories/'.$bookingCategories->id,
            $editedBooking_categories
        );

        $this->assertApiResponse($editedBooking_categories);
    }

    /**
     * @test
     */
    public function test_delete_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/booking_categories/'.$bookingCategories->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/booking_categories/'.$bookingCategories->id
        );

        $this->response->assertStatus(404);
    }
}
