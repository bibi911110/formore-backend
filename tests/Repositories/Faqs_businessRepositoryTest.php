<?php namespace Tests\Repositories;

use App\Models\Faqs_business;
use App\Repositories\Faqs_businessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Faqs_businessRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Faqs_businessRepository
     */
    protected $faqsBusinessRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->faqsBusinessRepo = \App::make(Faqs_businessRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->make()->toArray();

        $createdFaqs_business = $this->faqsBusinessRepo->create($faqsBusiness);

        $createdFaqs_business = $createdFaqs_business->toArray();
        $this->assertArrayHasKey('id', $createdFaqs_business);
        $this->assertNotNull($createdFaqs_business['id'], 'Created Faqs_business must have id specified');
        $this->assertNotNull(Faqs_business::find($createdFaqs_business['id']), 'Faqs_business with given id must be in DB');
        $this->assertModelData($faqsBusiness, $createdFaqs_business);
    }

    /**
     * @test read
     */
    public function test_read_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();

        $dbFaqs_business = $this->faqsBusinessRepo->find($faqsBusiness->id);

        $dbFaqs_business = $dbFaqs_business->toArray();
        $this->assertModelData($faqsBusiness->toArray(), $dbFaqs_business);
    }

    /**
     * @test update
     */
    public function test_update_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();
        $fakeFaqs_business = factory(Faqs_business::class)->make()->toArray();

        $updatedFaqs_business = $this->faqsBusinessRepo->update($fakeFaqs_business, $faqsBusiness->id);

        $this->assertModelData($fakeFaqs_business, $updatedFaqs_business->toArray());
        $dbFaqs_business = $this->faqsBusinessRepo->find($faqsBusiness->id);
        $this->assertModelData($fakeFaqs_business, $dbFaqs_business->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_faqs_business()
    {
        $faqsBusiness = factory(Faqs_business::class)->create();

        $resp = $this->faqsBusinessRepo->delete($faqsBusiness->id);

        $this->assertTrue($resp);
        $this->assertNull(Faqs_business::find($faqsBusiness->id), 'Faqs_business should not exist in DB');
    }
}
