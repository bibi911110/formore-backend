<?php namespace Tests\Repositories;

use App\Models\Booking_categories;
use App\Repositories\Booking_categoriesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Booking_categoriesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Booking_categoriesRepository
     */
    protected $bookingCategoriesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bookingCategoriesRepo = \App::make(Booking_categoriesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->make()->toArray();

        $createdBooking_categories = $this->bookingCategoriesRepo->create($bookingCategories);

        $createdBooking_categories = $createdBooking_categories->toArray();
        $this->assertArrayHasKey('id', $createdBooking_categories);
        $this->assertNotNull($createdBooking_categories['id'], 'Created Booking_categories must have id specified');
        $this->assertNotNull(Booking_categories::find($createdBooking_categories['id']), 'Booking_categories with given id must be in DB');
        $this->assertModelData($bookingCategories, $createdBooking_categories);
    }

    /**
     * @test read
     */
    public function test_read_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();

        $dbBooking_categories = $this->bookingCategoriesRepo->find($bookingCategories->id);

        $dbBooking_categories = $dbBooking_categories->toArray();
        $this->assertModelData($bookingCategories->toArray(), $dbBooking_categories);
    }

    /**
     * @test update
     */
    public function test_update_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();
        $fakeBooking_categories = factory(Booking_categories::class)->make()->toArray();

        $updatedBooking_categories = $this->bookingCategoriesRepo->update($fakeBooking_categories, $bookingCategories->id);

        $this->assertModelData($fakeBooking_categories, $updatedBooking_categories->toArray());
        $dbBooking_categories = $this->bookingCategoriesRepo->find($bookingCategories->id);
        $this->assertModelData($fakeBooking_categories, $dbBooking_categories->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_booking_categories()
    {
        $bookingCategories = factory(Booking_categories::class)->create();

        $resp = $this->bookingCategoriesRepo->delete($bookingCategories->id);

        $this->assertTrue($resp);
        $this->assertNull(Booking_categories::find($bookingCategories->id), 'Booking_categories should not exist in DB');
    }
}
